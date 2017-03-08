@extends('layouts.app')

@section('content')

    <div class="container">
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
                            <span class="highlight">未支付</span>
                            <a href="#" class="btn">去支付</a>
                        </dd>
                    </dl>
                    <dl class="info">
                        <dt>订单信息</dt>
                        <dd>
                            <span>订单编号：14888540645833</span>
                            <span>创建时间：2017-03-07 02:34:24</span>
                        </dd>
                        <dd class="title">
                            <a href="#">武隆仙女山两日游</a>
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
                                <th width="20%">操 &nbsp; 作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="title">
                                    <span class="info">3天两晚武隆自由行</span>
                                </td>
                                <td class="num">1</td>
                                <td class="price">￥555</td>
                                <td class="price">￥555</td>
                                <td class="action"></td>
                            </tr>
                            <tr>
                                <td class="total" colspan="5">
                                    <ul>
                                        <li>
                                            <span class="label">总价（实付款）:</span>
                                            <span class="price">￥555</span>
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
                            <span class="s1">姓名：晏均</span>
                            <span class="s1">手机：12345678910</span>
                            <span class="s1">邮箱：123456789@qq.com</span>
                        </dd>
                    </dl>
                    <dl class="supplier">
                        <dt>供应商信息：</dt>
                        <dd>
                            <span class="s0">供应商：虫师国际旅游集团</span>
                            <span class="s0">联系电话：68629315</span>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
@endsection