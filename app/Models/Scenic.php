<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scenic extends Model
{
    protected $table = 'scenic';

    protected $fillable = [
        'user_id',
        'parent_id',
        'name',
        'image',
        'info',
        'remark',
        'place_id',
        'category',
        'country_id',
        'hot',
        'status'
    ];

    protected $casts = [
        'category' => 'json'
    ];

    public function ticket()
    {
        return $this->hasMany('App\Models\Ticket', 'scenic_id', 'id');
    }

    public function parent()
    {
        return $this->hasMany('App\Models\Scenic', 'parent_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\Users', 'user_id', 'id');
    }

    public function distribution()
    {
        return $this->hasMany('App\Models\Distribution', 'scenic_id', 'id');
    }
}
