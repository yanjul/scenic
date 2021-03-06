<?php

namespace App\Http\Controllers;

use App\Models\Distribution;
use App\Models\OrderInfo;
use App\Models\OrderDetails;
use App\Models\OrderPaymentDetails;
use App\Models\UserInfo;
use Illuminate\Support\Facades\Auth;
use App\Models\Scenic;
use App\Services\OrderService;
use App\Services\ScenicService;
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
            'admission_time' => 'required_if:order_type,1|date|after:now',
            'pay_type' => 'required',
            'pay_mode' => 'required',
            'pay_account' => 'required',
        ]);
        $data = $request->input();
        $time = time() + 8 * 3600;
        $order = OrderInfo::with(['detail'=> function($query) {
            $query->with('ticket');
        }])->where(['sn' => $sn, 'id' => $data['id']])->first();
        $user_info = UserInfo::where('user_id', Auth::id())->first();
        if($user_info->money < $order->pay_price) {
            return redirect()->back()->withInput(['e'=> 1]);
        }
        if ($order && $order->order_status == 1 && $order->pay_status == 0) {
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
                foreach ($order->detail as $detail) {
                    if($detail->ticket->number == -1 || ($detail->ticket->number - $detail->ticket_numbers >= 0)){
                        if ($detail->ticket->number != -1) {
                            $detail->ticket->number -= $detail->ticket_numbers;
                            $detail->ticket->save();
                        }
                    } else {
                        DB::rollBack();
                        return redirect()->back();
                    }
                }
                $order->paid_price = $order->pay_price;
                $order->pay_status = 1;
                $order->order_status = 2;
                if ($request->has('remark')) {
                    $order->remark = $request->input('remark');
                }
                if(isset($data['admission_time'])) {
                    $order->admission_time = strtotime($data['admission_time'] . ' +1day') - 1;
                }
                $order->save();
                if ($data['order_type'] == 2) {
                    $scenic_service = new ScenicService();
                    $scenic_service->createDistribution($order);
                }
                OrderPaymentDetails::create($pay_data);
                $user_info->money = $user_info->money - $order->pay_price;
                $user_info->save();
                $user_info = UserInfo::where('user_id', $order->distributor_id)->first();
                $user_info->money = $user_info->money + $order->pay_price;
                $user_info->save();
                DB::commit();
                return redirect('user/order');
            } catch (\Exception $exception) {
                DB::rollBack();
                return redirect()->back();
            }
        }
        return redirect()->back();
    }

    public function reserve(Request $request) {
        if($request->isMethod('post')) {
            $this->validate($request, [
                'scenic_id' => 'required',
                'ticket_id' => 'required|array',
                'ticket_number' => 'required|array',
            ]);
            $data = $request->input();
            $orderService = new OrderService();
            $data = $orderService->getInitOrderData($data);
            Session::put('reserve_data', $data);
            return view('reserve')->with('data', $data);
        } else {
            if (Session::has('reserve_data')) {
                return view('reserve')->with('data', Session::get('reserve_data'));
            } else {
                return redirect('/');
            }
        }

    }

    public function createReserve(Request $request) {
        $this->validate($request, [
            'scenic_id' => 'required',
            'ticket_id' => 'required|array',
            'ticket_number' => 'required|array',
            'admission_time' => 'required|date|after:now',
        ]);
        $data = $request->input();
        $orderService = new OrderService();
        $order_data = $orderService->getInitOrderData($data);
        if ($order_data) {
            try {
                DB::beginTransaction();
                Scenic::where('id', $data['scenic_id'])->update(['hot' => $order_data['scenic']['hot']]);
                $order_data['info']['order_type'] = 3;
                $order_data['info']['admission_time'] = strtotime($data['admission_time'] . ' +1day') - 1;
                if(isset($data['remark'])) {
                    $order_data['info']['remark'] = $data['remark'];
                }

                $orderInfo = OrderInfo::create($order_data['info']);
                foreach ($order_data['detail'] as $value) {
                    OrderDetails::create(array_merge($value, ['order_id' => $orderInfo->id]));
                }
                DB::commit();
                Session::forget('reserve_data');
                return redirect('order/detail/' . $orderInfo->sn);
            } catch (\Exception $exception) {
                DB::rollBack();
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
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