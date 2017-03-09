@extends('layouts.app')

@section('css')
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/myPayment.css" rel="stylesheet">
@endsection

@section('content')
    <div class="content">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">我的订单</a>
            </li>
            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a>
            </li>
            <li role="presentation"><a href="#messages" aria-controls="messages" role="tab"
                                       data-toggle="tab">Messages</a></li>
            <li role="presentation"><a href="#settings" aria-controls="settings" role="tab"
                                       data-toggle="tab">Settings</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="home">...</div>
            <div role="tabpanel" class="tab-pane fade" id="profile">...</div>
            <div role="tabpanel" class="tab-pane fade" id="messages">...</div>
            <div role="tabpanel" class="tab-pane fade" id="settings">...</div>
        </div>
    </div>

    <!--底部-->
    <div class="index_footer">
        &copy;2017&nbsp;FootPrint&nbsp;脚印
    </div>
@endsection