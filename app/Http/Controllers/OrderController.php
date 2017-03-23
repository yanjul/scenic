<?php

namespace App\Http\Controllers;

use App\Models\Distribution;
use App\Models\OrderInfo;
use App\Models\OrderDetails;
use App\Models\OrderPaymentDetails;
use App\Models\Ticket;
use App\Models\UserInfo;
use Illuminate\Support\Facades\Auth;
use App\Models\Scenic;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    /**
     * 创建订单
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    function create(Request $request)
    {
        if ($request->isMethod('get')) {
            return redirect(Session::get('old_url', '/'));
        }
        $this->validate($request, [
            'scenic_id' => 'required',
            'ticket_id' => 'required|array',
            'ticket_number' => 'required|array',
        ]);
        $data = $request->input();
        $orderService = new OrderService();
        $order_data = $orderService->getInitOrderData($data);
        if ($order_data) {
            try {
                DB::beginTransaction();
                Scenic::where('id', $data['scenic_id'])->update(['hot' => $order_data['scenic']['hot']]);
                $orderInfo = OrderInfo::create($order_data['info']);
                foreach ($order_data['detail'] as $value) {
                    OrderDetails::create(array_merge($value, ['order_id' => $orderInfo->id]));
                }
                DB::commit();
                return redirect('order/pay/' . $orderInfo->sn);
            } catch (\Exception $exception) {
                DB::rollBack();
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }

    /**
     * 创建景区分销订单
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    function createDistribution(Request $request){
        $this->validate($request, [
            'distribution_id'=> 'required',
            'scenic_id'=> 'required'
        ]);
        $distribution = Distribution::with(['detail', 'scenic'])->where([
            'scenic_id'=> $request->input('scenic_id')
        ])->find($request->input('distribution_id'));
        if($distribution) {
            $data['scenic_id'] = $request->input('scenic_id');
            foreach ($distribution->detail as $key=>$value) {
                $data['ticket_id'][] = $value->ticket_id;
                $data['ticket_name'][] = $value->ticket_name;
                $data['ticket_number'][] = $value->ticket_number;
            }
            $orderService = new OrderService();
            $order_data = $orderService->getInitOrderData($data);
            if ($order_data) {
                try {
                    DB::beginTransaction();
                    $order_data['info']['order_type'] = 2;
                    $orderInfo = OrderInfo::create($order_data['info']);
                    foreach ($order_data['detail'] as $value) {
                        OrderDetails::create(array_merge($value, ['order_id' => $orderInfo->id]));
                    }
                    DB::commit();
                    return redirect('order/pay/' . $orderInfo->sn);
                } catch (\Exception $exception) {
                    DB::rollBack();
                    return redirect()->back();
                }
            }
        }
        return redirect()->back();
    }

    /**
     * 支付
     * @param $sn
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function pay($sn, Request $request)
    {
        if ($request->isMethod('get')) {
            $order = OrderInfo::with('detail')->where('sn', $sn)->first();
            return view('pay')->with('order', $order);
        }
        $this->validate($request, [
            'id' => 'required',
            'order_type' => 'required',
            'admission_time' => 'required_unless:order_type,2|date|after:now',
            'pay_type' => 'required',
            'pay_mode' => 'required',
            'pay_account' => 'required',
        ]);
        $data = $request->input();
        $time = time() + 8 * 3600;
        $order = OrderInfo::with('payment')->where(['sn' => $sn, 'id' => $data['id']])->first();
        $user_info = UserInfo::where('user_id', Auth::id())->first();
        if ($order && $order->order_status == 1 && $order->pay_status == 0 && !$order->payment && ($user_info->money - $order->pay_price >= 0)) {
            $pay_data = [
                'order_id' => $order->id,
                'order_sn' => $order->sn,
                'pay_type' => $data['pay_type'],
                'pay_mode' => $data['pay_mode'],
                'pay_account' => $data['pay_account'],
                'pay_price' => $order->pay_price,
                'pay_at' => $time,
                'debit_note' => $time . rand(1000, 9999)
            ];
            try {
                DB::beginTransaction();
                $order->paid_price = $order->pay_price;
                $order->pay_status = 1;
                $order->order_status = 2;
                if ($request->has('remark')) {
                    $order->remark = $request->input('remark');
                }
                if(isset($data['admission_time'])) {
                    $order->play_time = strtotime($data['admission_time'] . ' +1day') - 1;
                }
                $order->save();
                if ($data['order_type'] == 2) {
                    $scenic = Scenic::find($order->scenic_id);
                    $scenic->user_id = Auth::id();
                    $scenic = Scenic::create($scenic->toArray());
                    $orderDetail = OrderDetails::with('ticket')->where('order_id', $pay_data['order_id'])->get();
                    foreach ($orderDetail as $value) {
                        $value->ticket->scenic_id = $scenic->id;
                        $value->ticket->ticket_name = $value->ticket_name;
                        $value->ticket->ticket_price = $value->ticket_price;
                        $value->ticket->ticket_number = $value->ticket_number;
                        Ticket::create($value->ticket->toArray());
                    }
                }
                OrderPaymentDetails::create($pay_data);
                $user_info->money = $user_info->money - $order->pay_price;
                $user_info->save();
                DB::commit();
                return redirect('user/order');
            } catch (\Exception $exception) {
                DB::rollBack();
                return redirect(Session::get('old_url', '/'));
            }
        }
        return redirect(Session::get('old_url', '/'));
    }

    public function reserve(Request $request) {
        $this->validate($request, [
            'scenic_id' => 'required',
            'ticket_id' => 'required|array',
            'ticket_number' => 'required|array',
        ]);
        $data = $request->input();
        $orderService = new OrderService();
        $order_data = $orderService->getInitOrderData($data);
        return $order_data;
    }

    /**
     * 订单详情
     * @param $sn
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function detail($sn)
    {
        $order = OrderInfo::with(['detail', 'payment'])->where(['user_id' => Auth::id(), 'sn' => $sn])->first();
        if ($order) {
            $supplier = Scenic::with('user')->where('id', $order->scenic_id)->first();
            return view('user.order-detail')->with(['order' => $order, 'supplier' => $supplier]);
        }
        return redirect()->back();
    }

    /**
     * 取消订单
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancel(Request $request)
    {
        $this->validate($request, [
            'sn' => 'required'
        ]);
        $order = OrderInfo::where(['user_id' => Auth::id(), 'sn' => $request->input('sn')])->first();
        if ($order) {
            if ($order->order_status == 1 && $order->pay_status == 0) {
                $order->order_status = 4;
            } else if (($order->order_status == 2 || $order->order_status == 3) && $order->pay_status == 2) {
                $order->pay_status = 1;
            }
            $order->save();
        }
        return redirect()->back();
    }

    /**
     * 取消退款
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function refunds(Request $request)
    {
        $this->validate($request, [
            'sn' => 'required'
        ]);
        $order = OrderInfo::where(['user_id' => Auth::id(), 'sn' => $request->input('sn')])->first();
        if ($order) {
            if ($order->order_status == 2 && $order->pay_status == 1) {
                $order->pay_status = 2;
            } else if ($order->order_status == 3 && $order->pay_status == 1 && $order->play_time < (time() - 7200)) {
                $order->pay_status = 2;
            }
            $order->save();
        }
        return redirect()->back();
    }
}