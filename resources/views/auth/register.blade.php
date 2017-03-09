@extends('layouts.app')
@section('css')
    <link href="/css/materialize.css" rel="stylesheet">
    <style>
        .container {
            margin-top: 80px;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col m8 push-m2">

                <div class="row">
                    <div class="col m12">
                        注册
                    </div>
                </div>

                <form role="form" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="role_id" value="1">
                    <div class="{{ $errors->has('name') ? ' has-error' : '' }}">

                        <div class="row">
                            <div class="input-field col m12">
                                <i class="material-icons prefix"> assignment_ind</i>
                                <input id="name" type="text" class="validate" name="name" value="{{ old('name') }}"
                                       required autofocus>
                                <label for="name">用户名</label>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                    </div>

                    <div class="{{ $errors->has('email') ? ' has-error' : '' }}">

                        <div class="row">
                            <div class="input-field col m12">
                                <i class="material-icons prefix">email</i>
                                <input id="email" type="email" class="valiate" name="email"
                                       value="{{ old('email') }}" required>
                                <label for="email">邮箱</label>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="{{ $errors->has('role') ? ' has-error' : '' }}">

                        <div class="row">

                            <div class="col m12 ">
                                <div class="col m6">
                                    <i class="material-icons prefix"> supervisor_account</i> 角色
                                </div>
                                <div class="col m6">

                                    <span>
                                    <input name="role" value="0" type="radio" id="test1"/>
                                    <label for="test1">游客</label>
                                    </span>

                                    <span>
                                    <input name="role" value="1" type="radio" id="test2"/>
                                    <label for="test2">商家</label>
                                    </span>
                                </div>


                                {{-- <select id="role" class="validate" name="role">
                                     <option value="" disabled selected>角色</option>
                                     <option value="0" {{ old('role') == 0? 'selected': '' }}>游客</option>
                                     <option value="1" {{ old('role') == 1? 'selected': '' }}>商家</option>
                                 </select>

                                 @if ($errors->has('role'))
                                     <span class="help-block">
                                         <strong>{{ $errors->first('role') }}</strong>
                                     </span>
                                 @endif--}}

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
                        <div class="input-field col m12">
                            <i class="material-icons prefix">lock_outline</i>
                            <input id="password-confirm" type="password" class="validate"
                                   name="password_confirmation" required>
                            <label for="password-confirm">确认密码</label>
                        </div>
                    </div>


                    <div class="row">
                        <div class="input-field col m3 push-m9">
                            <button type="submit" class="waves-effect waves-light btn ">
                            注册   <i class="material-icons right"> mode_edit</i>
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection
