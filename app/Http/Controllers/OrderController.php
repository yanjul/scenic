<?php

namespace App\Http\Controllers;

use App\Models\OrderInfo;
use App\Models\OrderDetails;
use App\Models\OrderPaymentDetails;
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
                $orderInfo = OrderInfo::create($order_data['info']);
                foreach ($order_data['detail'] as $value) {
                    OrderDetails::create(array_merge($value, ['order_id' => $orderInfo->id]));
                }
//                OrderPaymentDetails::create(['order_id' => $orderInfo->id, 'order_sn' => $orderInfo->sn]);
                DB::commit();
                return redirect('order/pay/'.$orderInfo->sn);
            } catch (\Exception $exception) {
                DB::rollBack();
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }

    /**
     * 支付
     * @param $sn
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function pay($sn, Request $request){
        if ($request->isMethod('get')) {
            $order = OrderInfo::with('detail')->where('sn', $sn)->first();
            return view('pay')->with('order', $order);
        }
        $this->validate($request, [
            'id'=> 'required',
            'admission_time'=> 'required|date|after:now',
            'pay_type'=> 'required',
            'pay_mode'=> 'required',
            'pay_account'=> 'required',
        ]);
        $data = $request->input();
        $time = time();
        $order = OrderInfo::with('payment')->where(['sn'=> $sn, 'id'=> $data['id']])->first();
        if ($order && $order->order_status == 1 && $order->pay_status == 0 && !$order->payment) {
            $pay_data = [
                'order_id'=> $order->id,
                'order_sn'=> $order->sn,
                'pay_type'=> $data['pay_type'],
                'pay_mode'=> $data['pay_mode'],
                'pay_account'=> $data['pay_account'],
                'pay_price'=> $order->pay_price,
                'pay_at'=> $time,
                'debit_note'=> $time.rand(1000, 9999)
            ];

            try {
                DB::beginTransaction();
                $order->paid_price = $order->pay_price;
                $order->pay_status = 1;
                $order->order_status = 2;
                $order->remark = $request->input('remark', '');
                $order->play_time = strtotime($data['admission_time'].' +1day') - 1;
                $order->save();
                OrderPaymentDetails::create($pay_data);
                DB::commit();
                return redirect('user/order');
            } catch (\Exception $exception) {
                print_r($exception);
                DB::rollBack();
                return redirect(Session::get('old_url', '/'));
            }
        }
        return redirect(Session::get('old_url', '/'));

    }

    /**
     * 订单详情
     * @param $sn
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function detail($sn){
        $order = OrderInfo::with(['detail', 'payment'])->where(['user_id'=> Auth::id(), 'sn'=> $sn])->first();
        if($order){
            $supplier = Scenic::with('user')->where('id', $order->scenic_id)->first();
            return view('user.order-detail')->with(['order'=> $order, 'supplier'=> $supplier]);
        }
        return redirect()->back();
    }

    /**
     * 取消订单
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancel(Request $request){
        $this->validate($request, [
            'sn'=> 'required'
        ]);
        $order = OrderInfo::where(['user_id'=> Auth::id(), 'sn'=> $request->input('sn')])->first();
        if($order){
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
    public function refunds(Request $request){
        $this->validate($request, [
            'sn'=> 'required'
        ]);
        $order = OrderInfo::where(['user_id'=> Auth::id(), 'sn'=> $request->input('sn')])->first();
        if($order){
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