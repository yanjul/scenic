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
                                        <td colspan="6" class="o_info row">
                                            <span class="col-md-4">订单编号：{{$item->sn}}</span>
                                            <span class="col-md-4">创建时间：{{$item->created_at}}</span>
                                            <a href="/user/order-detail" class="order-check col-md-2">查看订单</a>
                                            <a href="" class="order-del col-md-2">删除订单</a>
                                        </td>
                                    </tr>
                                    @foreach($item->detail as $ticket)
                                        <tr>
                                            <td width="21%">
                                                <span class="mingcheng">{{$ticket->ticket_name}}</span></td>
                                            <td width="9%" class="num">{{$ticket->ticket_numbers}}</td>
                                            <td width="10%" class="price">{{$ticket->ticket_price}}¥</td>

                                            <td width="15%" class="total">{{$ticket->ticket_amount}}¥</td>
                                            <td width="15%" class="statue">
                                                @if($item->order_status == 1 && $item->pay_status == 0)
                                                    <span>待付款</span>
                                                @elseif($item->order_status == 2 && $item->pay_status == 1)
                                                    <span>待确认</span>
                                                @elseif($item->order_status == 2 && $item->pay_status == 2)
                                                    <span>退款中</span>
                                                @elseif($item->order_status == 2 && $item->pay_status == 3)
                                                    <span>退款完成</span>
                                                @elseif($item->order_status == 2 && $item->pay_status == 3)
                                                    <span>退款取消</span>
                                                @elseif($item->order_status == 3 && $item->pay_status == 1)
                                                    <span>交易成功</span>
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
                                                    <a>取消</a>
                                                </span>
                                                @elseif($item->order_status == 2 && $item->pay_status == 1)
                                                    <span>
                                                    <a>取消</a>
                                                </span>
                                                @elseif($item->order_status == 2 && $item->pay_status == 2)
                                                    <span>
                                                    <a>取消退款</a>
                                                </span>
                                                @elseif($item->order_status == 2 && $item->pay_status == 3)

                                                @elseif($item->order_status == 2 && $item->pay_status == 3)

                                                @elseif($item->order_status == 3 && $item->pay_status == 1)

                                                @elseif($item->order_status == 4 && $item->pay_status == 0)

                                                @else
                                                    <span>***bug***{{$item->order_status}}***{{$item->pay_status}}
                                                        ***</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
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
@endsection