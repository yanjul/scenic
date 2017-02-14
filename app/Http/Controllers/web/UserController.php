<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Users;
use App\Models\SysMsg;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller {

    public function index() {
//        Mail::send('user.main', [], function ($message){
//            $message->to('1737143630@qq.com')->subject('欢迎注册我们的网站，请激活您的账号！');
//        });
        return view('user.main');
    }

    public function getUserInfo(){

    }

    /**绑定手机
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function bindMobile(Request $request){
        if($request->isMethod('get')){
            return view('user.bind-mobile');
        }
        $this->validate($request, [
            'mobile'=> 'required',
            'code'=> 'required',
            'msg_id'=> 'required'
        ]);
        $data = $request->all();
        $msg = new \App\Http\Controllers\Web\MsgController();
        if ($msg->validateCode($data['code'], $data['mobile'], $data['msg_id'])) {
            $user = Auth::user();
            $user->telephone = $data['mobile'];
            $user->save();
        }
        return redirect('user/bind-mobile');
    }

    /**
     * 重置密码
     */
    public function resetPassword(Request $request){
        if($request->isMethod('get')){
            return view('user.reset-password');
        }
        $this->validate($request, [
            'old_password'=> 'required',
            'password'=> 'required|min:6|max:12|confirmed'
        ]);
        $user = Auth::user();
        if (Hash::check($request->input('old_password'), $user->password)){
            $user->password = bcrypt($request->input('password'));
            $user->save();
            return redirect('/user');
        }else{
            return redirect('/user/reset-password')->withErrors(['old_password'=>true])->withInput($request->all());
        }
    }
}