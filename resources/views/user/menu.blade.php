@section('css')
    <link rel="stylesheet" href="/css/user/main.css">
@endsection
<div class="col-md-3 sidenav">
    <div class="sidenav_content" id="myfoot">
        <h3><a href="/user">我的脚印</a></h3>
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
                    <span>数据分析</span>
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