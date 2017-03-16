<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{

    use Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'email',
        'name',
        'password',
        'telephone',
        'role',
        'status',
        'remember_token'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    public function scenic()
    {
        return $this->hasMany('App\Models\Scenic', 'user_id', 'id');
    }

    public function info()
    {
        return $this->hasOne('App\Models\UserInfo', 'user_id', 'id');
    }

}
