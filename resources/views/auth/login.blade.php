@extends('layouts.app')

@section('css')
    <link href="/css/materialize.css" rel="stylesheet">
    <style>
        .container {
            margin-top: 80px;
        }
    </style>
@endsection

@section('js')
    <script src="//cdn.bootcss.com/materialize/0.98.1/js/materialize.js"></script>
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col m6 push-m3">
                <div class="row">
                    <div class="col m12">
                        登录
                    </div>
                </div>
                <form role="form" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="{{ $errors->has('email') ? ' has-error' : '' }}">

                        <div class="row">
                            <div class="input-field col m12">
                                <i class="material-icons prefix">email</i>
                                <input id="email" type="email" class="validate" name="email"
                                       value="{{ old('email') }}" required autofocus>
                                <label for="email">邮箱</label>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        {{--<strong>{{ $errors->first('email') }}</strong>--}}
                                        <strong>您输入的密码错误</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                    </div>

                    <div class="{{ $errors->has('password') ? ' has-error' : '' }}">

                        <div class="row">
                            <div class="input-field col m12">
                                <i class="material-icons prefix">lock_outline</i>
                                <input id="password" type="password" class="validate" name="password" required>
                                <label for="password">密码</label>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                    </div>
                    <div class="col m5 push-m3">
                            <a  class="waves-effect waves-light btn right" href="{{ route('password.request') }}" style="color: white">忘记密码？</a>
                    </div>

                    <div class="col m4 push-m3 ">
                        <button type="submit" class="waves-effect waves-light btn" content="">
                            <i class="material-icons right">cloud</i> 登录
                        </button>


                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
