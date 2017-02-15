<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class SysCountries extends Model
{
    protected $table = 'sys_countries';

    protected $fillable = [
        'name',
        'code',
    ];
}