<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scenic extends Model {
    protected $table = 'scenic';

    protected $fillable = [
        'user_id',
        'name',
        'image',
        'info',
        'remark',
        'place_id',
        'country_id',
        'status'
    ];

    public function ticket() {
        return $this->hasMany('App\Models\Ticket');
    }

}
