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
                                <th width="15%">订单号</th>
                                <th width="15%">流水号</th>
                                <th width="10%">金额</th>
                                <th width="10%">支付方式</th>
                                <th width="10%">支付方式</th>
                                <th width="10%">支付账户</th>
                                <th width="10%">付款时间</th>
                                <th width="10%">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($order))
                                @foreach($order as $item)
                                    <tr>
                                        <td>{{$item->payment->order_sn}}</td>
                                        <td>{{$item->payment->debit_note}}</td>
                                        <td>{{$item->payment->pay_price}}</td>
                                        <td>
                                            @if($item->payment->pay_type === 1)
                                                <span>线上支付</span>
                                            @else
                                                <span>授信支付</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($item->payment->pay_mode === 1)
                                                <span>支付宝</span>
                                            @elseif($item->payment->pay_mode === 2)
                                                <span>微信</span>
                                            @else
                                                <span>银联</span>
                                            @endif
                                        </td>
                                        <td>{{$item->payment->pay_account}}</td>
                                        <td>{{date('Y-m-d H:i:s', $item->payment->pay_at)}}</td>
                                        <td><a class="btn btn-sm btn-success" href="/order/detail/{{$item->payment->order_sn}}">查看订单</a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8">暂无支付记录</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('user.footer')
@endsection