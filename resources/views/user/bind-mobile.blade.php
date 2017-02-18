@extends('layouts.app')

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
                                    <input type="tel" class="t" id="verification-code" name="code" value="{{old('code')}}">
                                </div>
                            </li>
                        </ul>
                    </div>
                <form id="code-form" class="form-horizontal" action="/user/bind-mobile" method="post">
                    {{ csrf_field() }}
                    <input id="msg-id" type="hidden" name="msg_id">
                    <div class="form-group">
                        <label class="control-label" for="mobile">手机号</label>
                        <input class="form-control" type="tel" id="mobile" name="mobile" value="{{old('mobile')}}">
                        @if($errors->has('mobile'))
                            <span>格式错误</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="verification-code">验证码</label>
                        <input class="form-control" type="tel" id="verification-code" name="code" value="{{old('code')}}">
                        <button id="btn-code" type="button">获取验证码</button>
                    </div>
                    <button class="btn" type="submit">绑定</button>
                </form>
                    <script>
                        window.onload = function () {
                            $('#btn-code').click(function () {
                                var form = document.querySelector('#code-form');
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
                                    },
                                    error: function () {

                                    }
                                })
                            });

                        }
                    </script>
                @endif
            </div>
        </div>
    </div>

@endsection