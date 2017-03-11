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
                            <div class="per-edit-msg">完善更多个人信息，有助于我们为您提供更加个性化的服务，脚印将尊重并保护您的隐私。</div>
                            <dl>
                                <dt>昵&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;称：</dt>
                                <dd>
                                    <span class="onSuccess">{{$info['name']}}</span>
                                </dd>
                            </dl>
                            <dl>
                                <dt>真实姓名：</dt>
                                <dd><span class="onSuccess">{{$info['info']['truename'] or '暂未填写'}}</span></dd>
                            </dl>
                            <dl>
                                <dt>手&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;机：</dt>
                                <dd>
                                    @if($info['telephone'])
                                        <span class="onSuccess">{{$info['telephone']}}</span>
                                    @else
                                        <a href="/user/bind-mobile">前去绑定手机</a>
                                    @endif
                                </dd>
                            </dl>
                            <dl>
                                <dt>公司地址：</dt>
                                <dd>
                                    <span class="onSuccess">{{$info['info']['company_address'] or '暂未填写'}}</span>
                                </dd>
                            </dl>
                            <dl>
                                <dt>邮&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;箱：</dt>
                                <dd>
                                    <span class="onSuccess">{{$info['email']}}</span>
                                </dd>
                            </dl>
                            <dl>
                                <dt>传&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;真：</dt>
                                <dd>
                                    <span class="onSuccess">{{$info['info']['fax'] or '暂未填写'}}</span>
                                </dd>
                            </dl>
                            <dl>
                                <dt>备&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;注：</dt>
                                <dd>
                                    <p class="onSuccess" style="width: 300px;height:80px;word-wrap:break-word; text-overflow:ellipsis;overflow:hidden;">{{$info['info']['remark'] or '暂未填写'}}</p>
                                </dd>
                            </dl>
                            <a id="sumBgn" class="btn05 btn" href="/user/info-update">修改</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection