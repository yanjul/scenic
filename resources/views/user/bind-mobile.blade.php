@extends('layouts.app')
@section('js')

@endsection
@section('content')
    <div class="container">
        <div class="row">
            @include('user.menu')
            <div class="col-md-9">
                <div class="breadcrumb">
                    <a href="/user">我的脚印</a>
                    >
                    <span>绑定手机</span>
                </div>
                @if(Auth::user()->telephone)
                    <span>您已绑定手机</span>
                @else
                    <form id="code-form" class="form-horizontal" action="/user/bind-mobile" method="post">
                        <input id="msg-id" type="hidden" name="msg_id" value="{{old('msg_id')}}">
                        <div class="section">
                            <ul class="popup-address">
                                <li>
                                    <p class="caption01">
                                        <span class="c4">*&nbsp;</span>
                                        手机号：
                                    </p>
                                    <div class="info">
                                        <input type="tel" class="t" id="mobile" name="mobile" value="{{old('mobile')}}">
                                        @if($errors->has('mobile'))
                                            <span>格式错误</span>
                                        @endif
                                    </div>
                                </li>
                                <li>
                                    <p class="caption01">
                                        <span class="c4">*&nbsp;</span>
                                        验证码：
                                    </p>
                                    <div class="info">
                                        <input type="tel" class="t" id="verification-code" name="code"
                                               value="{{old('code')}}">
                                        <button id="btn-code" type="button">获取验证码</button>
                                        @if($errors->has('code'))
                                            <span style="color: red">请填写正确的验证码</span>
                                        @endif
                                    </div>
                                </li>
                                <li>
                                    <button class="btn btn-primary binding" type="submit">绑定</button>
                                </li>
                            </ul>
                        </div>
                    </form>

                    <script>
                        window.onload = function () {
                            $('#btn-code').click(function () {
                                var form = document.querySelector('#code-form');
                                var mobileValue = document.getElementById('mobile').value;
                                var regTel = /^1\d{10}$/;

                                if(mobileValue == ''){
                                    alert('请填写电话号码');
                                }
                                else if(regTel.test(mobileValue)){
                                    $.ajax({
                                        url: '/get-code',
                                        type: 'GET',
                                        data: {
                                            mobile: form.querySelector('#mobile').value
                                        },
                                        dataType: 'JSON',
                                        success: function (data) {
                                            form.querySelector('#msg-id').value = data.msg_id;
                                            alert(data.code);
                                            form.querySelector('#verification-code').value = data.code;

                                        },
                                        error: function () {

                                        }
                                    });
                                }else {
                                    alert('请填写正确的手机号码')
                                }

                            });
                        }
                    </script>
                @endif
            </div>
        </div>
    </div>

@endsection