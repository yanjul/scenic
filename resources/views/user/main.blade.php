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
                                        <a href="">充值</a>
                                    </span>
                                </p>
                                {{--<p>--}}
                                    {{--<span class="mr10">--}}
                                        {{--<label>积&nbsp;&nbsp;&nbsp;分：</label>--}}
                                        {{--<a href="">0</a>--}}
                                    {{--</span>--}}
                                {{--</p>--}}
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
                            <span id="notAllPay">0</span>
                            )
                        </a>
                        <span class="i1"></span>
                        <a href="" class="c2">
                            待评论订单(
                            <span id="unComment">0</span>
                            )
                        </a>
                        <span class="i1"></span>
                        <a href="" class="c2">
                            未读站内信息(
                            <span id="noReadMsg">0</span>
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
                    <div style="margin-top: 20px;font-size: 12px;">没有符合条件的订单，最近有不少很赞的景区，快去看看吧！</div>
                </div>
            </div>
        </div>
    </div>
    @include('user.footer')
@endsection