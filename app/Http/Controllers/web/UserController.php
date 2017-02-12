<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller {

    public function index() {
        Mail::send('user.main', [], function ($message){
            $message->to('1737143630@qq.com')->subject('欢迎注册我们的网站，请激活您的账号！');
        });
        return view('user.main');
    }
}