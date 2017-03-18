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
    <script src="/js/materialize.js"></script>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col m6 push-m3">
                <div>重置密码</div>
                <div class="row">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form role="form" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col m12 input-field">
                                <i class="material-icons prefix">email</i>
                                <label for="email" >邮箱</label>


                                <input id="email" type="email" class="form-control" name="email"
                                       value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col m4 push-m5">
                                <button type="submit" class="btn btn-primary">
                                    输入邮箱获取重置密码链接
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
