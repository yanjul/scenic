@extends('layouts.app')

@section('css')
    <link href="/css/index.css" rel="stylesheet">
@endsection

@section('content')
    <!--搜索-->
    <div class="all">
        <div class="index_search clearfix">
            <div class="logo">
                <p style="font-size: 60px">👣</p>
                <p>FootPrint脚印</p>
            </div>
            <div class="search_box" >
                <form action="">
                    <div class="form-group">
                        <label for="search"></label>
                        <input type="text" id="search" name="search" placeholder="请输入景区名称">
                        <div  id="search_w" onclick="search()">搜索</div>
                        @section('js')
                        <script>
                            function search(){
                                var keywords = document.getElementById("search").value;
                                // alert(searchs); 
                                var url = geturl('/search', {keyword: keywords})
                                
                                location.href=url; 
                               
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
                                    for (var i = 0; i < arr.length; i ++) {
                                        params[arr[i].split('=')[0]] = arr[i].split('=')[1];
                                    }
                                    return params;
                                } else {
                                    return {};
                                }
                            }
                        </script>
                        @endsection
                    </div>
                </form>
            </div>
        </div>

        <!--分类-->
        <div class="bck clearfix">
            <div class="classify">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#inland" aria-controls="home" role="tab"
                                                              data-toggle="tab">景点类型</a></li>
                    <li role="presentation"><a href="#foreign" aria-controls="profile" role="tab" data-toggle="tab">适宜季节</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="inland">
                        <ul>
                            <li><a href="">城市</a></li>
                            <li><a href="">海岛</a></li>
                            <li><a href="">自然景观</a></li>
                        </ul>

                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="foreign">
                        <ul>
                            <li><a href="">春季</a></li>
                            <li><a href="">夏季</a></li>
                            <li><a href="">秋季</a></li>
                            <li><a href="">冬季</a></li>
                            <li><a href="">四季皆宜</a></li>
                        </ul>
                    </div>

                </div>
            </div>


            <!--滚动图-->

            <div class="top_content">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <img src="images/img1.jpg" alt="...">
                            <div class="carousel-caption">

                            </div>
                        </div>
                        <div class="item">
                            <img src="images/img2.jpg" alt="...">
                            <div class="carousel-caption">

                            </div>
                        </div>
                        <div class="item">
                            <img src="images/img3.jpeg" alt="...">
                            <div class="carousel-caption">

                            </div>
                        </div>

                    </div>

                    <!-- Controls -->
                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>

            <div class="jumbotron">
                <h2>凤凰2日游</h2>
                <p>只为在某个清晨或者黄昏，捧一盏茶，像《边城》里的翠翠一样，等一个偶然路过心上的人。</p>
                <p><a class="btn btn-sm btn-success btn-lg pull-right" href="#" role="button">了解更多</a></p>
            </div>
        </div>

        <!--内容-->
        <div class="content">
            <ul id="myTab" class="nav nav-tabs">
                <li class="active">
                    <a href="#hot" data-toggle="tab">
                        热门推荐
                    </a>
                </li>
                <li><a href="#sale" data-toggle="tab">限时特价</a></li>
            </ul>
            <div id="myTabContent" class="tab-content clearfix">
                <div class="tab-pane fade in active" id="hot">
                    <script type="text/javascript">
                        window.onload = function () {
                            $.ajax({
                                url: '/get-scenic',
                                type: 'GET',
                                data: {
                                    type: 'hot',
                                    length: 8
                                },
                                dataType: 'JSON',
                                success: function (data) {
                                    var container = $('#hot');
                                    for (var i = 0; i < data.length; i ++) {
                                        var content = $('<div class="hot_box"></div>');
                                        content.append('<a href="/scenic/'+data[i].id+'"><img src="'+data[i].image+'"></a>');
                                        content.append('<div class="hot_box_introduce"><p>'+data[i].name+'</p> <p>'+data[i].info+'</p> </div>');
                                        container.append(content);
                                    }

                                },
                                error: function () {}
                            });
                        }
                    </script>
                </div>

                <div class="tab-pane fade" id="sale">
                    <script>
//                        window.onload = function () {
//                            $.ajax({
//                                url: '/get-scenic',
//                                type: 'GET',
//                                data: {
//                                    type: 'price',
//                                    length: 8
//                                },
//                                dataType: 'JSON',
//                                success: function (data) {
//                                    var container = $('#sale');
//                                    for (var i = 0; i < data.length; i ++) {
//                                        var content = $('<div class="hot_box"></div>');
//                                        content.append('<a href="/scenic/'+data[i].id+'"><img src="'+data[i].image+'"></a>');
//                                        content.append('<div class="hot_box_introduce"><p>'+data[i].name+'<del>¥'+data[i].old_price+'</del><span>¥'+data[i].now_price+'</span></p> <p>'+data[i].info+'</p> </div>');
//                                        container.append(content);
//                                    }
//
//                                },
//                                error: function () {
//
//                                }
//                            });
//                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
    <!--底部-->
    <div class="index_footer">

        &copy;2017&nbsp;FootPrint&nbsp;脚印

    </div>
@endsection
