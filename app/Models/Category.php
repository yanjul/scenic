<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';

    protected $fillable = [
        'name',
        'parent_id',
        'type',
    ];

    public $timestamps = false;

    public function child(){
        return $this->hasMany('App\Models\Category', 'parent_id', 'id');
    }

}