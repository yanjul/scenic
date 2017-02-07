<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable {

    use Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'email',
        'name',
        'password',
        'telephone',
        'role_id',
        'status'
    ];

    protected $hidden = [
        'password'
    ];

    public $timestamps = false;
}
