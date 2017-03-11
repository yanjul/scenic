@extends('layouts.app')

@section('css')
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/pay.css" rel="stylesheet">
@endsection

@section('content')
    <!--商品详情内容-->
    <div class="detail_content">
        <form action="/order/pay/{{$order->sn}}" method="post">
            <table class="table table1 table-condensed table-bordered">
                <tr>
                    <td>订单号</td>
                    <td>{{$order->sn}}</td>
                </tr>
                <tr>
                    <td>景区名字</td>
                    <td>{{$order->scenic_name}}</td>
                </tr>
                <tr>
                    <td>门票信息</td>
                    <td style="border-top: 0" colspan="2">
                        <table class="table table-bordered" style="width: 100%">
                            <tr>
                                <td style="color: darkcyan">门票名字</td>
                                <td style="color: darkcyan">门票价格</td>
                                <td style="color: darkcyan">门票数量</td>
                                <td style="color: darkcyan">门票有效时间</td>
                            </tr>
                            @foreach($order->detail as $detail)
                                <tr>
                                    <td style="color: orange;">{{$detail->ticket_name}}</td>
                                    <td style="color: orange;">{{$detail->ticket_price}}</td>
                                    <td style="color: orange;">{{$detail->ticket_numbers}}</td>
                                    <td style="color: orange;">{{$detail->valid_time}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </td>
                </tr>

                <tr>

                </tr>
                <tr>
                    <td>游客姓名</td>
                    <td>{{$order->tourist_name}}</td>
                </tr>
                <tr>
                    <td>手机号</td>
                    <td>{{$order->mobile}}</td>
                </tr>
                <tr>
                    <td>价格</td>
                    <td>{{$order->pay_price}}</td>
                </tr>
                <tr>
                    <td><input type="hidden" name="id" value="{{$order->id}}"><label>入园时间</label></td>
                    <td>
                        <input type="date" name="admission_time">
                        @if($errors->has('admission_time'))
                            <div>error</div>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>支付方式</td>
                    <td>
                        <input type="radio" name="pay_type" value="1" checked>线上支付
                        <input type="radio" name="pay_type" value="2">受信支付
                    </td>
                </tr>
                <tr>
                    <td>支付途径</td>
                    <td>
                        <input type="radio" name="pay_mode" value="1" checked>支付宝
                        <input type="radio" name="pay_mode" value="2">微信
                        <input type="radio" name="pay_mode" value="3">银联
                    </td>
                </tr>
                <tr>
                    <td>支付账号</td>
                    <td>
                        <input type="tel" name="pay_account">
                        @if($errors->has('pay_account'))
                            <div>error</div>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>备注</td>
                    <td>
                        <textarea name="remark"></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit" class="btn btn-success pull-right">支付</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <!--底部-->
    <div class="index_footer">
        &copy;2017&nbsp;FootPrint&nbsp;脚印
    </div>
@endsection