@extends('layouts.app')

@section('content')
    <div class="container" style="min-height: 830px;">
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
                        <div class="scenic_infos">
                            <a href="" class="img-box">
                                <img src="{{$scenic['image']}}" width="300" height="240" class="scenic-img">
                            </a>
                            <div class="details">
                                <h5>{{$scenic['name']}}</h5>
                                <p>{{$scenic['info']}}</p>
                            </div>

                        </div>
                        <ul class="ticket-info">
                            @foreach($scenic['ticket'] as $ticket)
                                <li>
                                    <div class="ri-infos">
                                        <p class="row">
                                            <span class="col-md-3">门票名称：{{$ticket['name']}}</span>
                                            <span class="col-md-3">门票底价：{{$ticket['floor_price']}}元</span>
                                            <span class="col-md-3">门票价格：{{$ticket['price']}}元</span>
                                            <span class="col-md-3">门票数量：{{$ticket['number'] < 0? '无限制': $ticket['number']}}</span>
                                        </p>
                                        @foreach($ticket['custom_price'] as $item)
                                            <p class="row">
                                                <span class="col-md-3">
                                                    开始时间：<strong>{{date('Y-m-d', $item['start_time'])}}</strong>
                                                </span>
                                                <span class="col-md-3">
                                                    结束时间：<strong>{{date('Y-m-d', $item['end_time']-1)}}</strong>
                                                </span>
                                                 <span class="col-md-3">
                                                    限时价格：<strong>{{ $item['price']}}</strong>
                                                </span>
                                            </p>
                                        @endforeach
                                        <p class="row">
                                            <span class="col-md-3">有效时间：{{$ticket['valid_time']}}天</span>
                                            <span class="col-md-3">提前时间：{{$ticket['lead_time']}}天</span>
                                            <span class="col-md-3">最迟入园时间：{{$ticket['last_time']}} 点</span>
                                        </p>
                                        <p class="remark">备注：<span class="remark-box">{{$ticket['remark']}}</span></p>
                                        <div class="edit-btns">
                                            <a href="{{url('user/scenic/ticket/'.$ticket['id'])}}" class="btn btn-sm btn-success">修改门票</a>
                                            <a href="{{url('user/del-ticket/'.$ticket['id'])}}" class="btn btn-sm btn-danger">删除门票</a>
                                            @if($ticket['status'] == 1)
                                                <a href="/user/ticket/status?id={{$ticket['id']}}&status=0" class="btn btn-sm btn-danger">下架</a>
                                            @elseif($ticket['status'] == 0)
                                                <a href="/user/ticket/status?id={{$ticket['id']}}&status=1" class="btn btn-sm btn-success">上架</a>
                                            @else
                                                <a href="javascript:" title="已被强制下架" disabled class="btn btn-sm btn-danger">上架</a>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('user.footer')
@endsection