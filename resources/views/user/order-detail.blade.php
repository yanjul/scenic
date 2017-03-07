@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            @include('user.menu')
            <div class="col-md-9">
                <div class="breadcrumb">
                    <a href="/user">我的脚印</a>
                    >
                    <span>订单详情</span>
                </div>
                <div></div>
            </div>
        </div>
    </div>
@endsection