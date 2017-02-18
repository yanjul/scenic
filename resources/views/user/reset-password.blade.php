@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('user.menu')
            <div class="col-md-9">
                <div class="breadcrumb">
                    <a href="/user">我的脚印</a>
                    >
                    <span>修改密码</span>
                </div>
                <form class="form-horizontal" action="/user/reset-password" method="post">
                    {{ csrf_field() }}
                    <div class="section">
                        <ul class="popup-address">
                            <li>
                                <p class="caption01">
                                    <span class="c4">*&nbsp;</span>
                                    原始密码：
                                </p>
                                <div class="info">
                                    <input type="password" class="t" id="old-password" name="old_password"
                                           value="{{old('old_password')}}">
                                    @if($errors->has('old_password'))
                                        <span>密码错误</span>
                                    @endif
                                </div>
                            </li>
                            <li>
                                <p class="caption01">
                                    <span class="c4">*&nbsp;</span>
                                    新密码：
                                </p>
                                <div class="info">
                                    <input type="password" class="t" id="password" name="password"
                                           value="{{old('old_password')}}">
                                    @if($errors->has('password'))
                                        <span>密码错误</span>
                                    @endif
                                </div>
                            </li>
                            <li>
                                <p class="caption01">
                                    <span class="c4">*&nbsp;</span>
                                    新密码：
                                </p>
                                <div class="info">
                                    <input type="password" class="t" id="password-confirmation"
                                           name="password_confirmation" value="{{old('password_confirmation')}}">
                                    @if($errors->has('password_confirmation'))
                                        <span>密码错误</span>
                                    @endif
                                </div>
                            </li>
                            <li>
                                <button class="btn btn-primary binding" type="submit">确定修改</button>
                            </li>
                        </ul>
                    </div>
                </form>
                {{--<form class="form-horizontal" action="/user/reset-password" method="post">--}}
                    {{--{{ csrf_field() }}--}}
                    {{--<div class="form-group">--}}
                        {{--<label class="control-label" for="old-password">原始密码</label>--}}
                        {{--<input class="form-control" type="password" id="old-password" name="old_password"--}}
                               {{--value="{{old('old_password')}}">--}}
                        {{--@if($errors->has('old_password'))--}}
                            {{--<span>密码错误</span>--}}
                        {{--@endif--}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                        {{--<label for="password">新密码</label>--}}
                        {{--<input class="form-control" type="password" id="password" name="password"--}}
                               {{--value="{{old('password')}}">--}}
                        {{--@if($errors->has('password'))--}}
                            {{--<span>密码错误</span>--}}
                        {{--@endif--}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                        {{--<label for="password-confirmation">确认密码</label>--}}
                        {{--<input class="form-control" id="password-confirmation" type="password"--}}
                               {{--name="password_confirmation" value="{{old('password_confirmation')}}">--}}
                        {{--@if($errors->has('password_confirmation'))--}}
                            {{--<span>密码错误</span>--}}
                        {{--@endif--}}
                    {{--</div>--}}
                    {{--<button class="btn" type="submit">修改</button>--}}
                {{--</form>--}}
            </div>
        </div>
    </div>

@endsection