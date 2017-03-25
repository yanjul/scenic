<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model {
    protected $table = 'order_details';

    protected $fillable = [
        'order_id',
        'order_sn',
        'scenic_id',
        'scenic_name',
        'ticket_id',
        'ticket_name',
        'ticket_price',
        'ticket_floor_price',
        'ticket_numbers',
        'ticket_amount',
        'valid_time',
        'lead_time',
        'last_time',
        'order_status',
        'state',
    ];

    public function ticket(){
        return $this->belongsTo('App\Models\Ticket', 'ticket_id', 'id');
    }

}
