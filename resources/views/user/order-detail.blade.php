@extends('layouts.app')

@section('content')

    <div class="container" style="min-height: 830px;">
        <div class="row">
            @include('user.menu')
            <div class="col-md-9">
                <div class="breadcrumb">
                    <a href="/user">我的脚印</a>
                    >
                    <span>订单详情</span>
                </div>
                <div class="order-detail">
                    <dl class="desc">
                        <dt>订单详情</dt>
                        <dd>
                            当前订单状态：
                            @if($order->order_status == 1 && $order->pay_status == 0)
                                <span class="highlight">未支付</span>
                                <a href="/order/pay/{{$order->sn}}" class="btn">去支付</a>
                                <a href="/order/cancel?sn={{$order->sn}}" class="btn">取消</a>
                            @elseif($order->order_status == 2 && $order->pay_status == 1)
                                <span class="highlight">待确认</span>
                                <a href="/order/refunds?sn={{$order->sn}}" class="btn">申请退款</a>
                            @elseif(($order->order_status == 2 || $order->order_status == 3) && $order->pay_status == 2)
                                <span class="highlight">退款中</span>
                                <a href="/order/cancel?sn={{$order->sn}}" class="btn">取消退款</a>
                            @elseif($order->order_status == 4 && $order->pay_status == 3)
                                <span class="highlight">退款完成</span>
                            @elseif($order->order_status == 3 && $order->pay_status == 1 && $order->order_type == 2)
                                <span>订单完成</span>
                            @elseif($order->order_status == 3 && $order->pay_status == 1 && $order->admission_time >= time() && !$order->play_time && $order->order_type != 2)
                                <span>待入园</span>
                                <a href="/order/refunds?sn={{$order->sn}}" class="btn">申请退款</a>
                            @elseif($order->order_status == 3 && $order->pay_status == 1 && $order->admission_time < time() && !$order->play_time && $order->order_type != 2)
                                <span>已过期(订单完成)</span>
                            @elseif($order->order_status == 3 && $order->pay_status == 1 && $order->play_time && $order->order_type != 2)
                                <span>已入园(订单完成)</span>
                            @elseif($order->order_status == 4 && $order->pay_status == 0)
                                <span class="highlight">交易取消</span>
                            @else
                                <span>***bug***{{$order->order_status}}***{{$order->pay_status}}***</span>
                            @endif
                        </dd>
                    </dl>
                    <dl class="info">
                        <dt>订单信息</dt>
                        <dd class="row">
                            <span class="col-md-4">订单编号：{{$order->sn}}</span>
                            <span class="col-md-4">创建时间：{{date('Y-m-d H:i:s', strtotime($order->created_at.' +8hours'))}}</span>
                            @if($order->admission_time)
                                <span class="col-md-4">入园时间：{{date('Y-m-d', $order->admission_time)}}</span>
                            @endif
                        </dd>
                        <dd class="title">
                            <span>订单类型：{{$order->order_type == 2? '分销订单':($order->order_type == 3? '预定订单': '普通订单')}}</span>
                        </dd>
                        <dd class="title">
                            <a href="/scenic/{{$order->scenic_id}}">{{$order->scenic_name}}</a>
                        </dd>
                    </dl>
                    <div class="m-orderList">
                        <table cellpadding="0" cellspacing="0">
                            <thead>
                            <tr>
                                <th width="25%">名 &nbsp; 称</th>
                                <th width="10%">数 &nbsp; 量</th>
                                <th width="20%">单 &nbsp; 价</th>
                                <th width="25%">总 &nbsp; 价</th>
                                <th width="20%">有效时间</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order->detail as $ticket)
                                <tr>
                                    <td class="title">
                                        <span class="info">{{$ticket->ticket_name}}</span>
                                    </td>
                                    <td class="num">{{$ticket->ticket_numbers}}张</td>
                                    <td class="price">{{$ticket->ticket_price}}¥</td>
                                    <td class="price">{{$ticket->ticket_amount}}¥</td>
                                    <td class="action">{{$ticket->valid_time}}天</td>
                                </tr>
                            @endforeach

                            <tr>
                                <td class="total" colspan="5">
                                    <ul>
                                        <li>
                                            <span class="label">总价（实付款）:</span>
                                            <span class="price">{{$order->pay_price}}¥</span>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <dl class="person">
                        <dt>预定人信息：</dt>
                        <dd>
                            <span class="s1">姓名：{{$order->tourist_name}}</span>
                            <span class="s1">手机：{{$order->mobile}}</span>
                            <span class="s1">邮箱：{{Auth::user()->email}}</span>
                        </dd>
                    </dl>
                    <dl class="supplier">
                        <dt>供应商信息：</dt>
                        <dd>
                            <span class="s0">供应商：{{$supplier->user->name}}</span>
                            <span class="s0">联系电话：{{$supplier->user->telephone}}</span>
                        </dd>
                    </dl>
                    <dl class="supplier">
                        <dt>备注：</dt>
                        <dd>
                            <span>{{$order->remark}}</span>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
    @include('user.footer')
@endsection