@extends('layouts.app')

@section('content')
    <div class="container main">
        <div class="row">
            @include('user.menu')
            <div class="col-md-9 right-main" style="border: 1px solid;">
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