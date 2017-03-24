<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\OrderInfo;
use App\Models\OrderPaymentDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function getReserve(){
        $user_id = Auth::id();
        $order = OrderInfo::with(['detail'])->where(['user_id'=> $user_id,  'order_type'=> 3])->get();
        return view('user.reserve')->with('order', $order);
    }

    public function getAnalysis(Request $request) {
        $this->validate($request, [
            'action'=> 'required',
            'year'=> 'required_if:acton,sale'
        ]);
        $data = $request->all();
        $query = OrderInfo::query();
        $query->where('distributor_id', Auth::id());
        // 景区购买量
        if ($data['action'] == 'sale') {
            $query->select(DB::raw('DATE_FORMAT(created_at,\'%Y-%m\') as month'), DB::raw('count(id) as number'));
            $query->where(['order_status'=> 3, 'pay_status'=> 1]);
            $query->whereYear('created_at', $data['year']);
            $query->groupBy('month');
            $query->orderBy('month');
        }
        $data = $query->get();
        return $data;
    }

    public function analysis() {
        return view('user.analysis');
    }

}