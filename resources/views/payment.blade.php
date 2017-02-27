@extends('layouts.app')

@section('css')
    <link href="/css/payment.css" rel="stylesheet">
@endsection

@section('content')
    <!--付款内容-->
    <table class="table table1">
        <tr>
            <td style="color: crimson">购票人信息</td>
            <td>xxxxx</td>
        </tr>

        <tr>
            <td style="color: crimson">选择付款方式</td>
            <td>
                <input type="radio" name="way" value="1">微信
                <input type="radio" name="way" value="2">支付宝
                <input type="radio" name="way" value="3">银行卡
            </td>
        </tr>

        <tr>
            <td style="color: crimson;">商品清单</td>
            <td></td>
        </tr>

        <tr>
            <td style="border-top: 0;">
                <table class="table table-bordered" style="width: 100%" >
                    <tr>
                        <td style="color: darkcyan">商品名称</td>
                        <td style="color: darkcyan">价格</td>
                        <td style="color: darkcyan">数量</td>
                        <td style="color: darkcyan">价格总计</td>
                    </tr>
                    <tr>
                        <td>凤凰</td>
                        <td>100</td>
                        <td>3</td>
                        <td>300</td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td ></td>
            <td class="">待付总金额：</td>
        </tr>
        <tr>
            <td style="border-top: 0"></td>
            <td style="border-top: 0"><button class="btn btn-success">确认付款</button></td>
        </tr>
    </table>


    <!--底部-->
    <div class="index_footer">
        &copy;2017&nbsp;FootPrint&nbsp;脚印
    </div>
@endsection