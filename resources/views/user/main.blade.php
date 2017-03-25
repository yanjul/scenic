@extends('layouts.app')

@section('content')
    <div class="container" style="min-height: 830px;">
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
                                <p>
                                    <span class="mr10">
                                        <label>钱&nbsp;&nbsp;&nbsp;包：</label>
                                        <a href="">{{$user->info->money}}元</a>
                                        <a href="javascript:" onclick="recharge()">充值</a>
                                    </span>
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
                        <a href="/user/order" class="fr c7">查看所有订单>></a>
                    </div>
                    <div class="c-n">
                        @if(count($order))
                        <table width="100%" border="0" class="table03 table-striped" id="table-header">
                            <thead>
                                <tr>
                                    <th class="w6">订单号</th>
                                    <th class="w6">景区名</th>
                                    <th class="w13">创建时间</th>
                                    <th class="w7">应付金额</th>
                                    <th class="w4">订单状态</th>
                                    <th class="w4">操作</th>
                                </tr>
                            </thead>
                            <tbody class="">
                            @foreach($order as $item)
                                <tr>
                                    <td class="w6">{{$item->sn}}</td>
                                    <td class="w6">{{$item->scenic_name}}</td>
                                    <td class="w13">{{date('Y-m-d H:i:s', strtotime($item->created_at.' +8hours'))}}</td>
                                    <td class="w7">{{$item->pay_price}}¥</td>
                                    <td class="w4">
                                        @if($item->order_status == 1 && $item->pay_status == 0)
                                            <span>待付款</span>
                                        @elseif($item->order_status == 2 && $item->pay_status == 1)
                                            <span>待确认</span>
                                        @elseif(($item->order_status == 2 || $item->order_status == 3) && $item->pay_status == 2)
                                            <span>退款中</span>
                                        @elseif($item->order_status == 4 && $item->pay_status == 3)
                                            <span>退款完成</span>
                                        @elseif($item->order_status == 3 && $item->pay_status == 1 && $item->order_type == 2)
                                            <span>订单完成</span>
                                        @elseif($item->order_status == 3 && $item->pay_status == 1 && $item->admission_time >= time() && !$item->play_time && $item->order_type != 2)
                                            <span>待入园</span>
                                        @elseif($item->order_status == 3 && $item->pay_status == 1 && $item->admission_time < time() && !$item->play_time && $item->order_type != 2)
                                            <span>已过期(订单完成)</span>
                                        @elseif($item->order_status == 3 && $item->pay_status == 1 && $item->play_time)
                                            <span>已入园(订单完成)</span>
                                        @elseif($item->order_status == 4 && $item->pay_status == 0)
                                            <span>交易取消</span>
                                        @else
                                            <span>***bug***{{$item->order_status}}***{{$item->pay_status}}
                                                ***</span>
                                        @endif
                                    </td>
                                    <td class="w4">
                                        <a href="/order/detail/{{$item->sn}}" class="order-check">查看订单</a>
                                    </td>
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
    </div>
    @include('user.footer')
@endsection
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