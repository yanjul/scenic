<?php

namespace App\Services;

use App\Models\OrderInfo;
use App\Models\OrderDetails;
use App\Models\OrderPaymentDetails;
use App\Models\Scenic;
use App\Models\Ticket;
use App\Services\TicketService;
use Illuminate\Support\Facades\Auth;

class OrderService{

    private $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function getInitOrderData(array $data)
    {
        $order = [];
        $scenic = Scenic::with('user')->find($data['scenic_id']);
        $order['info']['sn'] = time().rand(1000, 9999);
        $order['info']['scenic_id'] = $scenic->id;
        $order['info']['scenic_name'] = $scenic->name;
        $order['info']['distributor_id'] = $scenic->user->id;
        $order['info']['distributor_name'] = $scenic->user->name;
        $order['info']['tourist_name'] = $this->user->name;
        $order['info']['mobile'] = $this->user->telephone;
        $order['detail'] = $this->getInitOrderDetailData($scenic, $data);
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
            $order_detail[$key]['scenic_id'] = $scenic->id;
            $order_detail[$key]['scenic_name'] = $scenic->name;
            $order_detail[$key]['ticket_name'] = $ticket->name;
            $order_detail[$key]['ticket_price'] = TicketService::getPrice($ticket);
            $order_detail[$key]['ticket_numbers'] = $data['ticket_number'][$key];
            $order_detail[$key]['ticket_amount'] = $order_detail[$key]['ticket_price'] * $order_detail[$key]['ticket_numbers'];
        }
        return $order_detail;
    }

}