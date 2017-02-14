<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\SysMsg;
use Illuminate\Http\Request;

class MsgController extends Controller
{

    /**发送验证码
     * @param Request $request
     * @return array
     */
    public function sendCode(Request $request)
    {
        $this->validate($request, [
            'mobile' => 'required'
        ]);
        if ($request->ajax()) {
            $data['code'] = rand('100000', '999999');
            $data['telephone'] = $request->input('mobile');
            $data['effective_time'] = 6;
            $data['created_at'] = date('Y-m-d H:i:s', time());
            $data['msg'] = "【FootPrint脚印】您的验证码是{$data['code']},请在{$data['effective_time']}分钟内验证";
            $data['is_success'] = 0;
            $msg = SysMsg::create($data);
            return [
                'mobile' => $data['telephone'],
                'code' => $data['code'],
                'msg_id' => $msg->id
            ];
        }
    }

    /**验证验证码
     * @param $code
     * @param $msg_id
     * @param $mobile
     * @return bool
     */
    public function validateCode($code, $mobile, $msg_id)
    {
        $msg = SysMsg::find($msg_id);
        if ($msg) {
            return ($code == $msg->code && $mobile == $msg->telephone && (time() - strtotime($msg->created_at)) < (60 * $msg->effective_time));
        }
        return false;
    }
}