<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\OrderInfo;

use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function getOrder(){
        $user_id = Auth::id();
        $order = OrderInfo::with(['detail', 'payment'])->where(['user_id'=> $user_id, 'order_type'=> 1])->get();
        return view('user.order')->with('order', $order);
    }

}