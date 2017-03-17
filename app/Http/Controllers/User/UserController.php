<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UserInfo;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function index()
    {

        $user = Users::with('info')->find(Auth::id())->toArray();

        return view('user.main')->with('user', $user);

    }

    public function getUserInfo()
    {

        $info = Users::with('info')->find(Auth::id())->toArray();

        return view('user.info')->with('info', $info);
    }

    /**绑定手机
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function bindMobile(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('user.bind-mobile');
        }
        $this->validate($request, [
            'mobile' => 'required',
            'code' => 'required',
            'msg_id' => 'required'
        ]);
        $data = $request->all();
        $msg = new \App\Http\Controllers\User\MsgController();
        if ($msg->validateCode($data['code'], $data['mobile'], $data['msg_id'])) {
            $user = Auth::user();
            $user->telephone = $data['mobile'];
            $user->save();
            $url = 'user/bind-mobile';
            if (Session::has('old_url')) {
                $url = Session::get('old_url', '/');
                Session::forget('old_url');
            }
            return redirect($url);
        }
        return redirect('user/bind-mobile')->withErrors(['code' => 'error'])->withInput($data);
    }

    /**
     * 重置密码
     */
    public function resetPassword(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('user.reset-password');
        }
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|min:6|max:12|confirmed'
        ]);
        $user = Auth::user();
        if (Hash::check($request->input('old_password'), $user->password)) {
            $user->password = bcrypt($request->input('password'));
            $user->save();
            Auth::logout();
            return redirect('/user');
        } else {
            return redirect('/user/reset-password')->withErrors(['old_password' => true])->withInput($request->all());
        }
    }

    /**修改用户信息
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateInfo(Request $request)
    {

        if ($request->isMethod('get')) {
            $info = Users::with('info')->find(Auth::id())->toArray();
            return view('user.info-update')->with('info', $info);
        }

        $this->validate($request, [

        ]);
        $data = $request->input();
        if ($data['name']) {
            Users::where('id', Auth::id())->update(['name' => $data['name']]);
            unset($data['name']);
        }

        UserInfo::where('user_id', Auth::id())->update($data);

        return redirect('user/info');
    }

    public function updatePhoto(Request $request)
    {
        if ($request->hasFile('image')) {

            $user_info = UserInfo::where('user_id', Auth::id())->first();
            if ($user_info->photo) {
                Storage::disk('image')->delete($user_info->photo);
            }
            $user_info->photo = '/' . config('filesystems.disks.image.root') . '/' .
                $request->file('image')->store($request->user()->id . '/info', 'image');
            $user_info->save();

        }
        return redirect()->back();
    }
}