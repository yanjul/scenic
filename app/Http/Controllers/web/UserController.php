<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
class UserController extends Controller {

    public function index() {
//        Mail::send('user.main', [], function ($message){
//            $message->to('1737143630@qq.com')->subject('欢迎注册我们的网站，请激活您的账号！');
//        });
        return view('user.main');
    }

    /**
     * 重置密码
     */
    public function resetPassword(Request $request){
        $this->validate($request, [
            'old_password'=> 'required',
            'password'=> 'required|min:6|max:12|confirmed'
        ]);
    }
}