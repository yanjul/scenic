<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SysMsg extends Model{

    protected $table = 'sys_msg';

    protected $fillable = [
        'telephone',
        'msg',
        'code',
        'effective_time',
        'is_success',
        'created_at'
    ];

    public $timestamps = false;
}