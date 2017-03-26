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

    public function getOrder(Request $request){
        $data = $request->all();
        $user_id = Auth::id();
        $query = OrderInfo::query();
        $query->with(['detail', 'payment'])->where(['user_id'=> $user_id]);
        if(array_key_exists('type', $data) && $data['type']) {
            $query->where('order_type', $data['type']);
        }
        if(array_key_exists('status', $data) && $data['status'] == 1) {
            $query->where(['order_status'=> 1, 'pay_status'=> 0]);
        }
        if(array_key_exists('status', $data) && $data['status'] == 2) {
            $query->where(['order_status'=> 2, 'pay_status'=> 1]);
        }
        if(array_key_exists('status', $data) && $data['status'] == 3) {
            $query->where(['pay_status'=> 2]);
        }
        if(array_key_exists('status', $data) && $data['status'] == 4) {
            $query->where(['order_status'=> 4, 'pay_status'=> 3]);
        }
        if(array_key_exists('status', $data) && $data['status'] == 5) {
            $query->where(['order_status'=> 3, 'pay_status'=> 1]);
        }
        if(array_key_exists('status', $data) && $data['status'] == 6) {
            $query->where(['order_status'=> 3, 'pay_status'=> 1]);
            $query->where('created_at', '>=', date('Y-m-d H:i:s', time()));
            $query->where('play_time', '=', 0);
        }
        if(array_key_exists('status', $data) && $data['status'] == 7) {
            $query->where(['order_status'=> 3, 'pay_status'=> 1]);
            $query->where('created_at', '<', date('Y-m-d H:i:s', time()));
            $query->where('play_time', '=', 0);
        }
        if(array_key_exists('status', $data) && $data['status'] == 8) {
            $query->where(['order_status'=> 3, 'pay_status'=> 1]);
            $query->where('play_time', '!=', 0);
        }
        if(array_key_exists('status', $data) && $data['status'] == 9) {
            $query->where(['order_status'=> 4, 'pay_status'=> 0]);
        }
        $order = $query->get();
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
        elseif ($data['action'] == 'profit') {
            $query->select(
                'order_info.scenic_name',
                DB::raw('sum(d.ticket_numbers) as number'),
                DB::raw('sum(d.ticket_price) as sum_price'),
                DB::raw('sum(d.ticket_floor_price) as floor_price'),
                DB::raw('(sum(d.ticket_price) - sum(d.ticket_floor_price)) as profit'));
            $query->leftJoin('order_details as d', 'order_info.id', 'd.order_id');
            $query->whereYear('order_info.created_at', $data['year']);
            $query->groupBy('order_info.scenic_id');
            $query->where(['order_status'=> 3, 'pay_status'=> 1]);
        }
        $data = $query->get();
        return $data;
    }

    public function analysis() {
        return view('user.analysis');
    }

}