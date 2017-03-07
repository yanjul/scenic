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
                <div class="m-box m-orderList">
                    <div class="bd">
                        <table cellspacing="0" cellpadding="0" class="table-header" id="table-header">
                            <thead>
                            <tr>
                                <th width="21%">名称</th>
                                <th width="9%">数量</th>
                                <th width="10%">单价</th>
                                <th width="15%">应付金额</th>
                                <th width="15%">订单状态</th>
                                <th width="15%">操作</th>
                            </tr>
                            </thead>
                        </table>
                        @if(count($order))
                            @foreach($order as $item)
                                <table>
                                    <tbody>
                                    <tr>
                                        <td colspan="6" class="o_info">
                                            <a href="" class="order-del">删除订单</a>
                                            <span>订单编号：{{$item->sn}}</span>
                                            <span>创建时间：{{$item->created_at}}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="title">
                                            <span class="mingcheng">{{$item->scenic_name}}</span>
                                            <a href="">
                                                <span style="word-break: break-all">这里放门票简单介绍</span>
                                            </a>
                                        </td>
                                        @foreach($item->detail as $ticket)
                                            <td width="9%" class="num">
                                                {{$ticket->ticket_numbers}}
                                            </td>
                                            <td width="10%" class="price">
                                                {{$ticket->ticket_price}}
                                            </td>
                                        @endforeach
                                        <td width="15%" class="total">{{$item->pay_price}}</td>
                                        <td width="15%" class="statue">
                                            @if($item->order_status == 1 && $item->pay_status == 0)
                                                <span>待付款</span>
                                                <span>
                                        <a href="/order/pay/{{$item->sn}}">付款</a>
                                        <a>取消</a>
                                    </span>
                                            @elseif($item->order_status == 2 && $item->pay_status == 1)
                                                <span>待确认</span>
                                                <span>
                                        <a>取消</a>
                                    </span>
                                            @elseif($item->order_status == 2 && $item->pay_status == 2)
                                                <span>退款中</span>
                                                <span>
                                        <a>取消退款</a>
                                    </span>
                                            @elseif($item->order_status == 2 && $item->pay_status == 3)
                                                <span>退款完成</span>
                                            @elseif($item->order_status == 2 && $item->pay_status == 3)
                                                <span>退款取消</span>
                                            @elseif($item->order_status == 3 && $item->pay_status == 1)
                                                <span>交易成功</span>
                                            @elseif($item->order_status == 4 && $item->pay_status == 0)
                                                <span>交易取消</span>
                                            @else
                                                <span>***bug***</span>
                                            @endif
                                        </td>
                                        <td width="15%" class="action">
                                            <a href="">去支付（跳转到支付页面）</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            @endforeach
                        @else
                            暂无订单<a href="/">去购买</a>
                        @endif
                    </div>
                </div>
                {{--<ul style="list-style: none">--}}
                    {{--@if(count($order))--}}
                        {{--@foreach($order as $item)--}}
                            {{--<li style="border: 1px solid #ff6666; margin-top: 8px; padding: 4px">--}}
                                {{--<span>订单号：{{$item->sn}}</span>--}}
                                {{--<span>景区名字：{{$item->scenic_name}}</span>--}}
                                {{--<span>订单状态：--}}
                                    {{--@if($item->order_status == 1 && $item->pay_status == 0)--}}
                                        {{--<span>待付款</span>--}}
                                        {{--<span>--}}
                                        {{--<a href="/order/pay/{{$item->sn}}">付款</a>--}}
                                        {{--<a>取消</a>--}}
                                    {{--</span>--}}
                                    {{--@elseif($item->order_status == 2 && $item->pay_status == 1)--}}
                                        {{--<span>待确认</span>--}}
                                        {{--<span>--}}
                                        {{--<a>取消</a>--}}
                                    {{--</span>--}}
                                    {{--@elseif($item->order_status == 2 && $item->pay_status == 2)--}}
                                        {{--<span>退款中</span>--}}
                                        {{--<span>--}}
                                        {{--<a>取消退款</a>--}}
                                    {{--</span>--}}
                                    {{--@elseif($item->order_status == 2 && $item->pay_status == 3)--}}
                                        {{--<span>退款完成</span>--}}
                                    {{--@elseif($item->order_status == 2 && $item->pay_status == 3)--}}
                                        {{--<span>退款取消</span>--}}
                                    {{--@elseif($item->order_status == 3 && $item->pay_status == 1)--}}
                                        {{--<span>交易成功</span>--}}
                                    {{--@elseif($item->order_status == 4 && $item->pay_status == 0)--}}
                                        {{--<span>交易取消</span>--}}
                                    {{--@else--}}
                                        {{--<span>***bug***</span>--}}
                                    {{--@endif--}}
                            {{--</span>--}}
                                {{--<div>--}}
                                    {{--<h5>门票信息</h5>--}}
                                    {{--@foreach($item->detail as $ticket)--}}
                                        {{--<div>--}}
                                            {{--<span>门票名字：{{$ticket->ticket_name}}</span>--}}
                                            {{--<span>门票价格：{{$ticket->ticket_price}}</span>--}}
                                            {{--<span>门票数量：{{$ticket->ticket_numbers}}</span>--}}
                                        {{--</div>--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}
                                {{--<div><span>总价：{{$item->pay_price}}</span><span>创建时间：{{$item->created_at}}</span></div>--}}
                            {{--</li>--}}
                        {{--@endforeach--}}
                    {{--@else--}}
                        {{--暂无订单<a href="/">去购买</a>--}}
                    {{--@endif--}}
                {{--</ul>--}}
            </div>
        </div>
    </div>
@endsection