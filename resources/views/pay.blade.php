@extends('layouts.app')

@section('css')
    <link href="/css/pay.css" rel="stylesheet">
@endsection

@section('content')
    <!--商品详情内容-->
    <div class="detail_content">
        <form action="/order/pay/{{$order->sn}}" method="post">
            <table class="table table1">
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
                    <td></td>
                </tr>
                @foreach($order->detail as $detail)
                    <tr>
                        <td style="border-top: 0">
                            <table class="table table-bordered" style="width: 100%">
                                <tr>
                                    <td style="color: darkcyan">门票名字</td>
                                    <td style="color: darkcyan">门票价格</td>
                                    <td style="color: darkcyan">门票数量</td>
                                    <td style="color: darkcyan">门票有效时间</td>
                                </tr>
                                <tr>
                                    <td>{{$detail->ticket_name}}</td>
                                    <td>{{$detail->ticket_price}}</td>
                                    <td>{{$detail->ticket_numbers}}</td>
                                    <td>{{$detail->valid_time}}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                @endforeach
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
                    <td><input type="date" name="admission_time"></td>
                </tr>
                <tr>
                    <td>支付方式</td>
                    <td><input type="radio" name="pay_type" value="1" checked>线上支付
                        <input type="radio" name="pay_type" value="2">受信支付

                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <button type="submit" class="btn btn-success">支付</button>
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