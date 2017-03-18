@extends('layouts.app')

@section('css')
    <link href="/css/materialize.css" rel="stylesheet">
    <link href="/css/index.css" rel="stylesheet">
@endsection
@section('js')
    <script src="/js/materialize.js"></script>
@endsection

@section('content')
    <!--搜索-->
    <div class="all">
        <div class="index_search clearfix">
            <div class="logo">
                <p style="font-size: 60px">👣</p>
                <p>FootPrint脚印</p>
            </div>
            <div class="search_box">
                <form action="">
                    <div class="form-group">
                        <label for="search"></label>
                        <input type="text" id="search" name="search" placeholder="请输入景区名称">
                        <div id="search_w" onclick="search()">搜索</div>
                        <script>
                            function search() {
                                var keywords = document.getElementById("search").value;
                                // alert(searchs);
                                var url = geturl('/search', {keyword: keywords})

                                location.href = url;

                            }
                            function geturl(baseUrl, obj) {
                                var url = baseUrl + '?';
                                for (var attr in obj) {
                                    url += attr + '=' + obj[attr].replace(/^(\s+)|(\s+)$/g, '') + '&';
                                }
                                return url.replace(/(\&)$/g, '');
                            }
                            function getParams(url) {
                                if (url.indexOf('?') < 0) {
                                    return {};
                                }
                                var str = url.replace(/^(.+\?)/, '');
                                if (str) {
                                    var arr = str.split('&');
                                    var params = {};
                                    for (var i = 0; i < arr.length; i++) {
                                        params[arr[i].split('=')[0]] = arr[i].split('=')[1];
                                    }
                                    return params;
                                } else {
                                    return {};
                                }
                            }
                        </script>
                    </div>
                </form>
            </div>
        </div>

        <!--分类-->
        <div class="row ">
            <div class="col s12">
                <div class="col s12 ">
                    <ul class="tabs">
                        <li class="tab col s6"><a class="active" href="#test1">景点类型</a></li>
                        <li class="tab col s6"><a href="#test2">适宜季节</a></li>

                    </ul>
                </div>
                <div id="test1" class="col s12">
                    <ul class="classify">
                        <li><a href="/search?type=4">城市</a></li>
                        <li><a href="/search?type=5">海岛</a></li>
                        <li><a href="/search?type=6">自然景观</a></li>
                        <li><a href="/search?type=7">其他</a></li>
                    </ul>
                </div>
                <div id="test2" class="col s12">
                    <ul class="classify">
                        <li><a href="/search?season=13">春季</a></li>
                        <li><a href="/search?season=14">夏季</a></li>
                        <li><a href="/search?season=15">秋季</a></li>
                        <li><a href="/search?season=16">冬季</a></li>
                        <li><a href="/search?season=17">四季皆宜</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!--滚动图-->

        <div class="row ">
            <div class="col s12">
                <div class="carousel">
                    <a class="carousel-item" href="#one!"><img src="/images/system/img1.jpg" class="responsive-img"></a>
                    <a class="carousel-item" href="#two!"><img src="/images/system/img2.jpg" class="responsive-img"></a>
                    <a class="carousel-item" href="#three!"><img src="/images/system/img3.jpeg" class="responsive-img"></a>
                </div>
            </div>
        </div>

        <!--内容-->
        <div class="row">
            <div class="col s12">
                <ul class="tabs">
                    <li class="tab col s4"><a class="active" href="#hot">热门推荐</a></li>
                    <li class="tab col s4" id="sale_btn"><a href="#sale">限时特价</a></li>
                    @if(Auth::check() && Auth::user()->role)
                        <li class="tab col s4" id="scenic_btn"><a href="#scenic">景区分销</a></li>
                    @endif
                </ul>
            </div>
            <div id="hot" class="col s12">
                <script type="text/javascript">
                    window.onload = function () {
                        $.ajax({
                            url: '/show-scenic',
                            type: 'GET',
                            data: {
                                type: 'hot',
                                length: 8
                            },
                            dataType: 'JSON',
                            success: function (data) {
                                var container = $('#hot');
                                for (var i = 0; i < data.length; i++) {
                                    var content = $('<div class="hot_box"></div>');
                                    content.append('<img class="materialboxed" src="' + data[i].image + '">');
                                    content.append('<a class="black" href="/scenic/' + data[i].id + '"><div class="hot_box_introduce"><p>' + data[i].name + '</p> <p>' + data[i].info + '</p> </div></a>');
                                    container.append(content);
                                }

                            },
                            error: function () {
                            }
                        });
                    }
                </script>
            </div>
            <div id="sale" class="col s12">
                <script>
                    var oSaleC = document.getElementById('sale');
                    var oSale = document.getElementById('sale_btn');
                    oSale.onclick = function () {
                        oSaleC.innerHTML = '';
                        $.ajax({
                            url: '/show-scenic',
                            type: 'GET',
                            data: {
                                type: 'price',
                                length: 8
                            },
                            dataType: 'JSON',
                            success: function (data) {
                                var container = $('#sale');
                                for (var i = 0; i < data.length; i++) {
                                    var content = $('<div class="hot_box"></div>');
                                    content.append('<img  src="' + data[i].image + '">');
                                    content.append('<a  class=" black" href="/scenic/' + data[i].id + '"><div class="hot_box_introduce"><p>' + data[i].name + '<del style="margin-left: 10px">¥' + data[i].old_price + '</del><span style="margin-left: 10px">¥' + data[i].now_price + '</span></p> <p>' + data[i].info + '</p> </div></a>');
                                    container.append(content);
                                }
                            },
                            error: function () {

                            }
                        });

                    }
                </script>
            </div>
            <div id="scenic" class="col s12">
                <script type="text/javascript">
                    var oScenic = document.getElementById('scenic_btn');
                    oScenic.onclick  = function () {
                        $.ajax({
                            url: '/show-scenic',
                            type: 'GET',
                            data: {
                                type: 'distribution',
                                length: 8
                            },
                            dataType: 'JSON',
                            success: function (data) {
                                var container = $('#scenic');
                                container.empty();
                                for (var i = 0; i < data.length; i++) {
                                    var content = $('<div class="hot_box"></div>');
                                    content.append('<img class="materialboxed" src="' + data[i].image + '">');
                                    content.append('<a class="black" href="/distribution/' + data[i].id + '"><div class="hot_box_introduce"><p>' + data[i].name + '</p> <p>' + data[i].info + '</p> </div></a>');
                                    container.append(content);
                                }

                            },
                            error: function () {}
                        });
                    }
                </script>
            </div>
        </div>
    </div>

    <!--底部-->
    @include('user.footer')
@endsection
