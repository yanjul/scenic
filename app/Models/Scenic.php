<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scenic extends Model {
    protected $table = 'scenic';

    protected $fillable = [
        'email',
        'name',
        'telephone',
        'status'
    ];

    public function ticket() {
        return $this->hasOne('App\Models\Ticket');
    }

}
