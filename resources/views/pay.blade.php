@extends('layouts.app')

@section('css')
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/pay.css" rel="stylesheet">
    <link href="/css/flatpickr.min.css" rel="stylesheet">
@endsection
@section('content')
    <!--商品详情内容-->
    <div class="detail_content">
        <form action="/order/pay/{{$order->sn}}" method="post" onsubmit="return queren()">
            <input type="hidden" name="id" value="{{$order->id}}">
            <input type="hidden" name="order_type" value="{{$order->order_type}}">
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
                @if($order->order_type == 1)
                <tr>
                    <td><label>入园时间</label></td>
                    <td>
                        <input id="flatpickr-tryme" placeholder="请选择日期" value="{{ old('admission_time') }}" name="admission_time">
                        @if($errors->has('admission_time'))
                            <div style="color: brown">请您选择正确的入园时间</div>
                        @endif
                    </td>
                </tr>
                @endif
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
                        <input type="tel" name="pay_account"  value="{{ old('pay_account') }}">
                        @if($errors->has('pay_account'))
                            <div style="color: brown">请您输入支付账号</div>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>备注</td>
                    <td>
                        <textarea name="remark">{{ old('remark') }}</textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">

                        <button type ='submit' class="btn btn-success pull-right" data-toggle="modal" id="zhifu" data-target="#myModal">支付</button>

                    </td>
                </tr>
            </table>
        </form>
    </div>
    <!--底部-->
    @include('user.footer')
    @if(old('e'))
        <script>alert('账户余额不足。。。')</script>
    @endif
@endsection
@section('js')
    <script src="/js/flatpickr.min.js"></script>
    <script>
            function queren() {
                return confirm("确定支付吗？");
            }
            document.getElementById("flatpickr-tryme").flatpickr();
    </script>
    <!--底部-->
    @include('user.footer')
@endsection