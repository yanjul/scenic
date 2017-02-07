<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model {
    protected $table = 'ticket';

    protected $fillable = [
        'scenic_id',
        'name',
        'number',
        'price',
        'custom_price',
        'valid_time',
        'lead_time',
        'last_time',
        'state'
    ];

    protected $casts = [
        'custom_price'=> 'json'
    ];
}
