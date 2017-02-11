@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="/css/user/main.css">
@endsection
@section('content')

    <div class="container main">
        <div class="row">
            <div class="col-md-3 sidenav">
                <div class="sidenav_content" id="myfoot">
                    <h3><a href="javascript:;">我的脚印</a></h3>
                    <dl>
                        <dt>景区管理</dt>
                        <dd>
                            <a href="javascript:;">
                                <span>景区展示</span>
                            </a>
                        </dd>
                        <dd>
                            <a href="javascript:;">
                                <span>景区添加</span>
                            </a>
                        </dd>
                    </dl>
                    <dl>
                        <dt>订单管理</dt>
                        <dd>
                            <a href="">
                                <span>交易记录</span>
                            </a>
                        </dd>
                        <dd>
                            <a href="">
                                <span>订单状态</span>
                            </a>
                        </dd>
                    </dl>
                    <dl>
                        <dt>账户管理</dt>
                        <dd>
                            <a href="">
                                <span>个人信息</span>
                            </a>
                        </dd>
                        <dd>
                            <a href="">
                                <span>修改密码</span>
                            </a>
                        </dd>
                    </dl>
                    <dl>
                        <dt>数据分析</dt>

                    </dl>
                </div>
            </div>
            <div class="col-md-9 right-main" style="border: 1px solid;">

            </div>
        </div>
    </div>
    <h3><a href="/user/scenic">景区</a></h3>


@endsection