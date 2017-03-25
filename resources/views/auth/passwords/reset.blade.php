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
                <div>重置密码</div>
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form class="form-horizontal" role="form" method="POST" action="{{ route('password.request') }}">
                    {{ csrf_field() }}

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="col m12 input-field">
                            <i class="material-icons prefix">email</i>
                        <label for="email" >邮箱</label>
                            <input id="email" type="email" class="form-control" name="email"
                                   value="{{ $email or old('email') }}" required autofocus>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="{{ $errors->has('password') ? ' has-error' : '' }}">
                        <div class="col m12 input-field">
                            <i class="material-icons prefix">lock_outline</i>
                        <label for="password" >密码</label>
                            <input id="password" type="password" class="form-control" name="password" required>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <div class="col m12 input-field">
                            <i class="material-icons prefix">lock_outline</i>
                        <label for="password-confirm" >确认密码</label>
                            <input id="password-confirm" type="password" class="form-control"
                                   name="password_confirmation" required>

                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col m4 push-m8">
                            <button type="submit" class="btn btn-primary">
                                 重置密码
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
