@extends('layouts.app')

@section('content')
    <div class="container" style="min-height: 830px;">
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
                                        <td colspan="6" class="o_info row">
                                            <span class="col-md-3">订单编号：{{$item->sn}}</span>
                                            <span class="col-md-4">创建时间：{{date('Y-m-d H:i:s', strtotime($item->created_at.' +8hours'))}}</span>
                                            <span class="col-md-3">入园时间：{{date('Y-m-d', $item->admission_time)}}</span>
                                            <a href="/order/detail/{{$item->sn}}" class="order-check col-md-2">查看订单</a>
                                            {{--<a href="" class="order-del col-md-2">删除订单</a>--}}
                                        </td>
                                    </tr>
                                    @foreach($item->detail as $ticket)
                                        <tr>
                                            <td width="21%">
                                                <span class="mingcheng">{{$ticket->ticket_name}}</span></td>
                                            <td width="9%" class="num">{{$ticket->ticket_numbers}}</td>
                                            <td width="10%" class="price">{{$ticket->ticket_price}}¥</td>

                                            <td width="15%" class="total">{{$ticket->ticket_amount}}¥</td>
                                            <td width="30%" colspan="2"></td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td width="55%%" colspan="2"></td>
                                        <td width="9%"><span>总价</span></td>
                                        <td width="10%" class="total">{{$item->pay_price}}¥</td>
                                        <td width="15%" class="statue">
                                            @if($item->order_status == 1 && $item->pay_status == 0)
                                                <span>待付款</span>
                                            @elseif($item->order_status == 2 && $item->pay_status == 1)
                                                <span>待确认</span>
                                            @elseif(($item->order_status == 2 || $item->order_status == 3) && $item->pay_status == 2)
                                                <span>退款中</span>
                                            @elseif($item->order_status == 2 && $item->pay_status == 3)
                                                <span>退款完成</span>
                                            @elseif($item->order_status == 3 && $item->pay_status == 1 && !$item->admission_time)
                                                <span>待入园</span>
                                            @elseif($item->order_status == 3 && $item->pay_status == 1 && $item->admission_time)
                                                <span>已入园(订单完成)</span>
                                            @elseif($item->order_status == 4 && $item->pay_status == 0)
                                                <span>交易取消</span>
                                            @else
                                                <span>***bug***{{$item->order_status}}***{{$item->pay_status}}
                                                    ***</span>
                                            @endif
                                        </td>
                                        <td width="15%">
                                            @if($item->order_status == 1 && $item->pay_status == 0)
                                                <span>
                                                    <a href="/order/pay/{{$item->sn}}">付款</a>
                                                    <a href="/order/cancel?sn={{$item->sn}}">取消</a>
                                                </span>
                                            @elseif($item->order_status == 2 && $item->pay_status == 1)
                                                <span>
                                                    <a href="/order/refunds?sn={{$item->sn}}">申请退款</a>
                                                </span>
                                            @elseif(($item->order_status == 3 || $item->order_status == 2) && $item->pay_status == 2)
                                                <span>
                                                    <a href="/order/cancel?sn={{$item->sn}}">取消退款</a>
                                                </span>
                                            @elseif($item->order_status == 2 && $item->pay_status == 3)

                                            @elseif($item->order_status == 3 && $item->pay_status == 1 && !$item->admission_time)
                                                <span>
                                                    <a href="/order/refunds?sn={{$item->sn}}">申请退款</a>
                                                </span>
                                            @elseif($item->order_status == 3 && $item->pay_status == 1 && $item->admission_time)
                                                <span>已入园(订单完成)</span>
                                            @elseif($item->order_status == 4 && $item->pay_status == 0)
                                            @else
                                                <span>***bug***{{$item->order_status}}***{{$item->pay_status}}
                                                    ***</span>
                                            @endif
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
            </div>
        </div>
    </div>
    @include('user.footer')
@endsection