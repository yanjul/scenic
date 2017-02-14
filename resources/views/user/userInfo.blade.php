{{--个人信息页面--}}
@extends('layouts.app')

@section('content')
    <div class="container main">
        <div class="row">
            @include('user.menu')

            <div class="col-md-9">
                <div class="breadcrumb">
                    <a href="/user">我的脚印</a>

                    <span>景区添加</span>
                </div>
            </div>
        </div>
    </div>
@endsection