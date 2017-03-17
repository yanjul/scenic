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
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
            <div class="header_logo"><a href="/">FootPrint脚印👣</a></div>
            <div class="header_content ">
                <span>Hi~</span>
                @if(Auth::guest())
                    <span>
                        <a href="{{ route('login') }}">[请登录]</a>
                        <a href="{{ route('register') }}">[请注册]</a>
                    </span>
                @else
                    <span>
                        <img src="{{Auth::user()->info->photo ?: '/images/system/default-photo.jpg'}}" width="32" height="32">
                        <span>{{ Auth::user()->name }}</span>
                        <a  style="margin-left: 10px" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            退出
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </span>
                    <ul>
                        <li>|</li>
                        <li><a href="/user">我的脚印</a></li>
                        <li>|</li>
                        <li><a href="/user/order">我的订单</a></li>
                    </ul>
                @endif
            </div>
        </div>
        @yield('content')
    </div>
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="/js/select.js"></script>
    @yield('js')
</body>
</html>
