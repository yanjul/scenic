<?php

namespace App\Services;

use App\Models\OrderInfo;
use App\Models\OrderDetails;
use App\Models\OrderPaymentDetails;
use App\Models\Scenic;
use App\Models\Ticket;
use App\Services\TicketService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderService{

    private $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function getInitOrderData(array $data)
    {
        $order = [];
        $scenic = Scenic::with(['ticket'=> function($query) use($data) {
            $query->whereIn('id', $data['ticket_id'])->where('status', 1);
        }])->where('status', 1)->find($data['scenic_id']);
        if (!$scenic || ($scenic && ($scenic->user_id == Auth::id() || count($scenic->ticket) != count($data['ticket_id'])))){
            return false;
        }
        $order['scenic']['hot'] = $scenic->hot + 1;
        $order['info']['sn'] = time().rand(1000, 9999);
        $order['info']['user_id'] = Auth::id();
        $order['info']['scenic_id'] = $scenic->id;
        $order['info']['scenic_name'] = $scenic->name;
        $order['info']['distributor_id'] = $scenic->user->id;
        $order['info']['distributor_name'] = $scenic->user->name;
        $order['info']['tourist_name'] = $this->user->name;
        $order['info']['mobile'] = $this->user->telephone;
        $order['detail'] = $this->getInitOrderDetailData($scenic, $data);
        $order['info']['pay_status'] = 0;
        $order['info']['order_type'] = 1;
        $order['info']['order_status'] = 1;
        $order['info']['pay_price'] = 0;
        foreach ($order['detail'] as $key=>$item){
            $order['detail'][$key]['order_sn'] = $order['info']['sn'];
            $order['info']['pay_price'] += $item['ticket_amount'];
        }
        return $order;
    }

    private function getInitOrderDetailData(Scenic $scenic, $data)
    {
        $order_detail = [];
        foreach ($data['ticket_id'] as $key=>$value){
            $ticket = Ticket::find($value);
            if($ticket) {
                $order_detail[$key]['scenic_id'] = $scenic->id;
                $order_detail[$key]['scenic_name'] = $scenic->name;
                $order_detail[$key]['ticket_id'] = $ticket->id;
                $order_detail[$key]['ticket_name'] = $ticket->name;
                $order_detail[$key]['ticket_price'] = TicketService::getPrice($ticket);
                $order_detail[$key]['ticket_floor_price'] = $ticket->floor_price;
                $order_detail[$key]['ticket_numbers'] = $data['ticket_number'][$key];
                $order_detail[$key]['ticket_amount'] = $order_detail[$key]['ticket_price'] * $order_detail[$key]['ticket_numbers'];
                $order_detail[$key]['valid_time'] = $ticket->valid_time;
                $order_detail[$key]['lead_time'] = $ticket->lead_time;
                $order_detail[$key]['last_time'] = $ticket->last_time;
            }
        }
        return $order_detail;
    }

    public function count() {
        $order = OrderInfo::where('user_id', Auth::id())->get();
        $data = ['pay'=> 0, 'confirm'=> 0, 'play'=> 0];
        foreach ($order as $item) {
            if($item->order_status == 1 && $item->pay_status == 0) {
                $data['pay'] += 1;
            } elseif ($item->order_status == 2 && $item->pay_status == 1) {
                $data['confirm'] += 1;
            } elseif ($item->order_status == 3 && $item->pay_status == 1 && !$item->admission_time) {
                $data['play'] += 1;
            }
        }
        return $data;
    }

}