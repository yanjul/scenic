<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'scenic') }}</title>

    <!-- Styles -->
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/layout.css">
@yield('css')
<!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([ 'csrfToken' => csrf_token() ]) !!};
    </script>
</head>
<body>
<div id="app">
    <div class="header_index clearfix">
        <div class="header_logo">FootPrint脚印👣</div>
        <div class="header_content clearfix">
            <span>Hi~</span>
            <span>
                    <a href="#">[请登录]</a>
                    <a href="#">[请注册]</a>
            </span>

            <ul>
                <li>|</li>
                <li><a href="#">我的脚印</a></li>
                <li>|</li>
                <li><a href="#">我的订单</a></li>

            </ul>
        </div>
    </div>
    @yield('content')
</div>

<!-- Scripts -->
<script src="/js/app.js"></script>
@yield('js')
</body>
</html>
