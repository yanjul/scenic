@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('user.menu')
            <div class="col-md-9">
                <div class="breadcrumb">
                    <a href="/user">我的脚印</a>
                    >
                    <span>门票查看</span>
                </div>
                <div class="section">
                    <div class="con">
                        <ul class="ticket-info">
                            <li>
                                <a href="" class="img-box">
                                    <img src="{{$scenic['image']}}" width="300" height="240" class="scenic-img">
                                </a>
                                @foreach($scenic['ticket'] as $ticket)
                                <div class="ri-infos">
                                    <h5>景区名字：{{$scenic['name']}}</h5>
                                    @foreach($ticket['custom_price'] as $item)
                                    <p>
                                        <span class="start-time">
                                            开始时间：<strong>{{date('Y-m-d H:i:s', $item['start_time'])}}</strong>
                                        </span>
                                        <span class="end-time">
                                            结束时间：<strong>{{date('Y-m-d H:i:s', $item['end_time'])}}</strong>
                                        </span>
                                    </p>
                                    @endforeach
                                    <div class="ticket-price">
                                        <span>票价：{{$item['price']}}元</span>
                                    </div>
                                    <p class="valid-time">有效时间：{{$ticket['valid_time']}}天</p>
                                    <p class="lead-time">提前时间：{{$ticket['lead_time']}}天</p>
                                    <p class="latest-time">最迟入园时间：{{$ticket['last_time']}} 点</p>
                                    <p class="remark">备注：<span class="remark-box">{{$ticket['remark']}}</span></p>
                                    <div class="edit-btns">
                                        <a href="{{url('user/scenic/ticket/'.$ticket['id'])}}" class="update-btn">修改门票</a>
                                        <a href="{{url('user/del-ticket/'.$ticket['id'])}}" class="delete-btn">删除门票</a>
                                    </div>
                                </div>
                                @endforeach
                            </li>
                        </ul>
                    </div>
                </div>
                {{--<div>--}}
                    {{--<h4>景区名字</h4>--}}
                    {{--<img src="{{$scenic['image']}}" height="200">--}}
                {{--</div>--}}
                {{--@foreach($scenic['ticket'] as $ticket)--}}
                    {{--<div style="border: 2px solid #f0ad4e; display: inline-block; vertical-align: top; width: 240px; height: 240px">--}}
                        {{--<p>名称{{$ticket['name']}}</p>--}}
                        {{--<p>价格{{$ticket['price']}}</p>--}}
                        {{--<p>--}}
                            {{--自定义价格--}}
                        {{--@foreach($ticket['custom_price'] as $item)--}}
                            {{--<ul style="list-style: none">--}}
                                {{--<li style="display: inline-block">开始时间{{date('Y-m-d H:i:s', $item['start_time'])}}</li>--}}
                                {{--<li style="display: inline-block">结束时间{{date('Y-m-d H:i:s', $item['end_time'])}}</li>--}}
                                {{--<li style="display: inline-block">价格{{$item['price']}}</li>--}}
                            {{--</ul>--}}
                            {{--@endforeach--}}
                            {{--</p>--}}
                            {{--<p>有效时间{{$ticket['valid_time']}}天</p>--}}
                            {{--<p>提前时间{{$ticket['lead_time']}}天</p>--}}
                            {{--<p>最迟入园时间{{$ticket['last_time']}}点</p>--}}
                            {{--<p>备注{{$ticket['remark']}}点</p>--}}
                            {{--<p>--}}
                                {{--<a href="{{url('user/scenic/ticket/'.$ticket['id'])}}">修改</a>--}}
                                {{--<a href="{{url('user/del-ticket/'.$ticket['id'])}}">删除</a>--}}
                            {{--</p>--}}
                    {{--</div>--}}
                {{--@endforeach--}}
            </div>
        </div>
    </div>
@endsection