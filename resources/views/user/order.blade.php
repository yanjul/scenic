@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('user.menu')
            <div class="col-md-9">
                <div class="breadcrumb">
                    <a href="/user">我的脚印</a>
                    >
                    <span>订单</span>
                </div>
                <ul style="list-style: none">
                    @foreach($order as $item)
                        <li style="border: 1px solid #ff6666; margin-top: 8px; padding: 4px">
                            <span>订单号：{{$item->sn}}</span>
                            <span>订单状态：
                                @if($item->order_status == 0)
                                    <span>未支付</span>
                                @elseif($item->order_status == 1)
                                    <span>已支付</span>
                                @elseif($item->order_status == 2)
                                    <span>已入园</span>
                                @elseif($item->order_status == 3)
                                    <span>退款申请中</span>
                                @elseif($item->order_status == 4)
                                    <span>退款成功</span>
                                @elseif($item->order_status == 5)
                                    <span>已取消</span>
                                @else
                                    <span>已完成</span>
                                @endif
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection