@extends('layouts.app')

@section('content')
    <div class="container main">
        <div class="row">
            @include('user.menu')
            <div class="col-md-9">
                <div class="breadcrumb">
                    <a href="/user">我的脚印 </a>
                    >
                    <span>个人信息</span>
                </div>
                <div class="tab-myfoot">
                    <ul class="title">
                        <li>
                            <a href="" class="on">基本资料</a>
                        </li>
                        <li>
                            <a href="">头像设置</a>
                        </li>
                        <li>
                            <a href="">兴趣爱好</a>
                        </li>
                    </ul>
                    <div class="c-n box01">
                        <div class="per-edit-list">
                            <form action="" id="myinfoform">
                                <div class="per-edit-msg">完善更多个人信息，有助于我们为您提供更加个性化的服务，脚印将尊重并保护您的隐私。</div>
                                <dl>
                                    <dt>昵&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;称：</dt>
                                    <dd>
                                        <input type="text" class="input-text-2">
                                        <span class="onSuccess">{{$info['name']}}</span>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>真实姓名：</dt>
                                    <dd><input type="text" class="input-text-2"></dd>
                                </dl>
                                <dl>
                                    <dt>公司地址：</dt>
                                    <dd>
                                        <input type="text" id="company_adress" class="input-text-3">
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>邮&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;箱：</dt>
                                    <dd>
                                        <input type="text" id="email" class="input-text-3">
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>传&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;真：</dt>
                                    <dd>
                                        <input type="text" id="fax" class="input-text-3">
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>备&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;注：</dt>
                                    <dd>
                                        <textarea  id="remark" class="input-text-3" style="resize: none;width: 300px;height: 80px;min-height: 60px;min-width: 200px;"></textarea>
                                    </dd>
                                </dl>
                                <button id="sumBgn" class="btn05" type="submit">保存</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div>用户名: {{$info['name']}}</div>
                <div>头像
                    @if($info['info']['photo'])
                        <img src="{{$info['info']['photo']}}" style="height: 80px; width: 80px; border-radius: 50%">
                    @endif
                </div>
                <div>邮箱：{{$info['email']}}</div>
                <div>手机
                    @if($info['telephone'])
                        <span>{{$info['telephone']}}</span>
                    @else
                        <a href="/user/bind-mobile">前去绑定手机</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection