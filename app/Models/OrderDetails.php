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
        'ticket_name',
        'ticket_price',
        'ticket_numbers',
        'ticket_amount',
        'valid_time',
        'lead_time',
        'last_time',
        'order_status',
        'state',
    ];


}
