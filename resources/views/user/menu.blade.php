@section('css')
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/user/main.css">
@endsection
<div class="col-md-3 sidenav">
    <div class="sidenav_content" id="myfoot">
        <h3><a href="/user">我的脚印</a></h3>
        @if(Auth::user()->role == 1)
        <dl>
            <dt>景区管理</dt>
            <dd>
                <a href="/user/scenic">
                    <span>景区展示</span>
                </a>
            </dd>
            <dd>
                <a href="/user/add-scenic">
                    <span>景区添加</span>
                </a>
            </dd>
            <dd>
                <a href="/user/scenic/distribution">
                    <span>景区分销</span>
                </a>
            </dd>
        </dl>
        @endif
        <dl>
            <dt>订单管理</dt>
            <dd>
                <a href="/user/order">
                    <span>订单状态</span>
                </a>
            </dd>
            <dd>
                <a href="/user/reserve">
                    <span>预定订单</span>
                </a>
            </dd>
            <dd>
                <a href="/user/payment">
                    <span>交易记录</span>
                </a>
            </dd>
            @if(Auth::user()->role == 1)
                <dd>
                    <a href="/user/analysis?action=sale&year=2017">
                        <span>数据分析</span>
                    </a>
                </dd>
            @endif
        </dl>
        <dl>
            <dt>账户管理</dt>
            <dd>
                <a href="/user/info">
                    <span>个人信息</span>
                </a>
            </dd>
            <dd>
                <a href="/user/bind-mobile">
                    <span>绑定手机</span>
                </a>
            </dd>
            <dd>
                <a href="/user/reset-password">
                    <span>修改密码</span>
                </a>
            </dd>
        </dl>

    </div>
</div>