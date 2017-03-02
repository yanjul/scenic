@extends('layouts.app')

@section('css')
    <link href="/css/detail.css" rel="stylesheet">
@endsection

@section('content')
    <!--商品详情内容-->
    <div class="detail_content">
        <div class="detail_head">
            <ul>
                <li><a href="#">脚印</a></li>
            </ul>
        </div>
        <div>
            <ul>
                <li><b>订单号</b>{{$order->sn}}</li>
                <li><b>景区名字</b>{{$order->scenic_name}}</li>
                <li>
                    <b>门票信息</b>
                    @foreach($order->detail as $detail)
                        <ul style="border: 1px solid #ff6666">
                            <li style="display: inline-block"><b>门票名字</b>{{$detail->ticket_name}}</li>
                            <li style="display: inline-block"><b>门票价格</b>{{$detail->ticket_price}}</li>
                            <li style="display: inline-block"><b>门票数量</b>{{$detail->ticket_numbers}}</li>
                            <li style="display: inline-block"><b>门票有效时间</b>{{$detail->valid_time}}</li>
                        </ul>
                    @endforeach
                </li>
                <li><b>游客姓名</b>{{$order->tourist_name}}</li>
                <li><b>手机号</b>{{$order->mobile}}</li>
                <li><b>价格</b>{{$order->pay_price}}</li>
            </ul>
            <form action="/order/pay/{{$order->sn}}" method="post">
                <input type="hidden" name="id" value="{{$order->id}}">
                <label>入园时间</label><input type="date" name="admission_time">
                <label>支付方式</label><input type="radio" name="pay_type" value="1" checked>线上支付
                <input type="radio" name="pay_type" value="2">受信支付
                <button type="submit">支付</button>
            </form>
        </div>
    </div>
    <!--底部-->
    <div class="index_footer">
        &copy;2017&nbsp;FootPrint&nbsp;脚印
    </div>
@endsection