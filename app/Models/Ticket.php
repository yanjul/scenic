<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'ticket';

    protected $fillable = [
        'scenic_id',
        'scenic_name',
        'parent_id',
        'name',
        'price',
        'floor_price',
        'custom_price',
        'number',
        'valid_time',
        'lead_time',
        'last_time',
        'remark',
        'status'
    ];

    protected $casts = [
        'custom_price' => 'json'
    ];

    public function scenic()
    {
        return $this->belongsTo('App\Models\scenic', 'scenic_id', 'id');
    }

    public function parent()
    {
        return $this->hasMany('App\Models\Ticket', 'parent_id', 'id');
    }

}
