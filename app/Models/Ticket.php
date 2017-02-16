<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model {
    protected $table = 'ticket';

    protected $fillable = [
        'scenic_id',
        'name',
        'price',
        'custom_price',
        'valid_time',
        'lead_time',
        'last_time',
        'remark',
        'state'
    ];

    protected $casts = [
        'custom_price'=> 'json'
    ];

    public function scenic(){
        return $this->belongsTo('App\Models\scenic');
    }
}
