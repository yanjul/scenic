@extends('layouts.app')

@section('content')
    <div class="container main" style="min-height: 830px;">
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
                        <li class="on">
                           基本资料
                        </li>
                    </ul>
                    <div class="c-n box01">
                        <div class="per-edit-list">
                            <form action="/user/info-update" id="myinfoform" method="post">
                                <div class="per-edit-msg">完善更多个人信息，有助于我们为您提供更加个性化的服务，脚印将尊重并保护您的隐私。</div>
                                <dl>
                                    <dt>昵&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;称：</dt>
                                    <dd>
                                        <input type="text" class="input-text-2" name="name" value="{{$info['name']}}">
                                        @if($errors->has('name'))
                                            error
                                        @endif
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>真实姓名：</dt>
                                    <dd>
                                        <input type="text" class="input-text-2" id="true_name" name="truename" value="{{$info['info']['truename']}}">
                                        <span class="valid ValidTrueName"></span>
                                    </dd>
                                    @if($errors->has('truename'))
                                        error
                                    @endif
                                </dl>
                                <dl>
                                    <dt>公司地址：</dt>
                                    <dd>
                                        <input type="text" id="company_address" class="input-text-3" name="company_address" value="{{$info['info']['company_address']}}">
                                        <span class="valid ValidTrueName"></span>
                                        @if($errors->has('company_adress'))
                                            error
                                        @endif
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>邮&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;箱：</dt>
                                    <dd>
                                        <input type="text" id="email" class="input-text-3" value="{{$info['email']}}" disabled>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>传&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;真：</dt>
                                    <dd>
                                        <input type="text" id="fax" class="input-text-3" name="fax" value="{{$info['info']['fax']}}">
                                        @if($errors->has('fax'))
                                            error
                                        @endif
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>备&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;注：</dt>
                                    <dd>
                                        <textarea  id="remark" class="input-text-3" name="remark" style="resize: none;width: 300px;height: 80px;min-height: 60px;min-width: 200px;">{{$info['info']['remark']}}</textarea>
                                        @if($errors->has('remark'))
                                            error
                                        @endif
                                    </dd>
                                </dl>
                                <button id="su mBgn" class="btn05  saveBtn" type="subm it">保存</button>
                            </form>
                            <script>
//                                window.onload = function () {
//                                    $(".saveBtn").click(function () {
//                                        if($("#true_name").val() ==''){
//                                            $(".ValidTrueName").text("真实姓名不能为空！")
//                                        }
//                                        else if($("#company_address").val() ==''){
//                                            $(".ValidTrueName").text("公司地址不能为空！")
//                                        }
//
//                                    })
//                                }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('user.footer')
@endsection