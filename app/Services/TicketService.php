<?php

namespace App\Services;

use App\Models\Ticket;

class TicketService{

    /**获取当前时间价格
     * @param Ticket $ticket
     * @return mixed
     */
    public static function getPrice(Ticket $ticket){
        $price = $ticket->price;
        $time = time();
        foreach ($ticket->custom_price as $item){
            if (($time > $item['start_time']) && ($time < $item['end_time'])) {
                $price = $item['price'];
            }
        }
        return $price;
    }
}