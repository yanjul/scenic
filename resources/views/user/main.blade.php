@extends('layouts.app')

@section('content')
    <div class="container main" style="min-height: 830px;">
        <div class="row">
            @include('user.menu')
            <div class="col-md-9">
                <div class="userInfo_box">
                    <div class="clear">
                        <div class="infos">
                            <div class="infos-lf">
                                <div class="img">
                                    <img src="{{$user->info->photo ?: '/images/system/default-photo.jpg'}}" alt="" id="userPhoto">
                                </div>
                                <a href="/user/info">编辑个人信息</a>
                            </div>
                            <div class="infos-ri">
                                <p class="username">
                                    <span>您好，</span><span class="c4" id="myindexnickname">{{$user->name}}!</span>
                                </p>
                                {{--<p id="growInfo">--}}
                                    {{--<label>成 长 值：0</label>--}}
                                {{--</p>--}}
                                <p>
                                    <span class="mr10">
                                        <label>钱&nbsp;&nbsp;&nbsp;包：</label>
                                        <a href="">{{$user->info->money}}元</a>
                                        <a href="javascript:" onclick="recharge()">充值</a>
                                    </span>
                                </p>
                                {{--<p>--}}
                                    {{--<span class="mr10">--}}
                                        {{--<label>积&nbsp;&nbsp;&nbsp;分：</label>--}}
                                        {{--<a href="">0</a>--}}
                                    {{--</span>--}}
                                {{--</p>--}}
                                @section('js')
                                <script>
                                    function recharge() {
                                        var num = prompt('输入充值金额');
                                        num = num.toString().trim();
                                        if (num !== null) {
                                            if((/^([1-9]\d{0,9}|0)([.]?|(\.\d{1,2})?)$/).test(num)) {
                                                $.ajax({
                                                    url: '/user/recharge',
                                                    type: 'POST',
                                                    data: {value: num},
                                                    dataType: 'JSON',
                                                    success: function (data) {
                                                        if (data) {
                                                            alert('充值成功');
                                                            window.location.reload();
                                                        } else {
                                                            alert('充值失败');
                                                        }
                                                    },
                                                    error: function () {
                                                        alert('充值失败');
                                                    }
                                                });
                                            } else {
                                                alert('格式错误')
                                            }
                                        }
                                    }
                                </script>
                                @endsection
                            </div>
                        </div>
                        <div class="user-state">
                            <p class="last-time">
                                <span class="mr10">ID：0001</span>
                                上次登陆时间：2017年02月14日 14:30:20
                            </p>
                            <div class="credit-card">
                                <p>
                                    <a href="#" class="coll">绑定中国脚印信用卡</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="user-msg">
                        <a href="" class="c2">
                            待支付订单(
                            <span id="notAllPay">{{$count['pay']}}</span>
                            )
                        </a>
                        <span class="i1"></span>
                        <a href="" class="c2">
                            待确认订单(
                            <span id="unComment">{{$count['confirm']}}</span>
                            )
                        </a>
                        <span class="i1"></span>
                        <a href="" class="c2">
                            待入园订单(
                            <span id="noReadMsg">{{$count['play']}}</span>
                            )
                        </a>
                    </div>
                </div>
                <div class="section index-table01">
                    <div class="hd">
                        <h2>近期订单列表</h2>
                        <span class="subtit"></span>
                        <a href="" class="fr c7">查看所有订单>></a>
                    </div>
                    <div class="c-n">
                        <table width="100%" border="0" class="table03">
                            <thead>
                                <tr>
                                    <th class="w6">景区名字</th>
                                    <th class="w6">票价</th>
                                    <th class="w13">数量</th>
                                    <th class="w7">订单金额</th>
                                    <th class="w4">交易状态</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="table-list01" id="list">
                    @if(count($order))
                        <table cellspacing="0" cellpadding="0" class="table-header" id="table-header">
                            <thead>
                            <tr>
                                <th width="21%">订单号</th>
                                <th width="9%">景区名</th>
                                <th width="10%">创建时间</th>
                                <th width="15%">应付金额</th>
                                <th width="15%">订单状态</th>
                                <th width="15%">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order as $item)
                                <tr>
                                    <td>{{$item->sn}}</td>
                                    <td>{{$item->scenic_name}}</td>
                                    <td>{{date('Y-m-d H:i:s', strtotime($item->created_at.' +8hours'))}}</td>
                                    <td>{{$item->pay_price}}¥</td>
                                    <td>
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
                                        @endif</td>
                                    <td><a href="/order/detail/{{$item->sn}}" class="order-check col-md-offset-2 col-md-2">查看订单</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div style="margin-top: 20px;font-size: 12px;">没有符合条件的订单，最近有不少很赞的景区，快去看看吧！</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include('user.footer')
@endsection