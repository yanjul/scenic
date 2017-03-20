<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\OrderInfo;
use App\Models\OrderPaymentDetails;

use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function getOrder(){
        $user_id = Auth::id();
        $order = OrderInfo::with(['detail', 'payment'])->where(['user_id'=> $user_id])->get();
        return view('user.order')->with('order', $order);
    }

    public function getPayment(){
        $user_id = Auth::id();
        $order = OrderInfo::with(['payment'])->where(['user_id'=> $user_id, 'order_type'=> 1])->get();
        foreach ($order as $key=>$value) {
            if (!$value->payment) {
                unset($order[$key]);
            }
        }
        return view('user.payment')->with('order', $order);
    }

}