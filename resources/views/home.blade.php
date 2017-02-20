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
                        <input type="text" id="search" placeholder="请输入景区名称">
                        <div  id="search_w">搜索</div>
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
                    <script>
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
                    {{--<script>--}}
                        {{--window.onload = function () {--}}
                            {{--$.ajax({--}}
                                {{--url: '/get-scenic',--}}
                                {{--type: 'GET',--}}
                                {{--data: {--}}
                                    {{--type: 'price',--}}
                                    {{--length: 8--}}
                                {{--},--}}
                                {{--dataType: 'JSON',--}}
                                {{--success: function (data) {--}}
                                    {{--var container = $('#sale');--}}
                                    {{--for (var i = 0; i < data.length; i ++) {--}}
                                        {{--var content = $('<div class="hot_box"></div>');--}}
                                        {{--content.append('<a href="/scenic/'+data[i].id+'"><img src="'+data[i].image+'"></a>');--}}
                                        {{--content.append('<div class="hot_box_introduce"><p>'+data[i].name+'<del>¥'+data[i].old_price+'</del><span>¥'+data[i].now_price+'</span></p> <p>'+data[i].info+'</p> </div>');--}}
                                        {{--container.append(content);--}}
                                    {{--}--}}

                                {{--},--}}
                                {{--error: function () {--}}

                                {{--}--}}
                            {{--});--}}
                        {{--}--}}
                    {{--</script>--}}





                    {{--<div class="hot_box">--}}
                        {{--<a href="#"><img src="images/fenghuang.jpg"></a>--}}
                        {{--<div class="hot_box_introduce">--}}
                            {{--<p>凤凰&nbsp;&nbsp;--}}
                                {{--<del>¥100</del>--}}
                                {{--&nbsp;&nbsp;<span>¥80</span></p>--}}
                            {{--<p>"凤凰是个美丽安逸的小城，风景好，民风也淳朴。这里有古朴的气息..."</p>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="hot_box">--}}
                        {{--<a href="#"><img src="images/sanya.jpg"></a>--}}
                        {{--<div class="hot_box_introduce">--}}
                            {{--<p>三亚&nbsp;&nbsp;--}}
                                {{--<del>¥200</del>--}}
                                {{--&nbsp;&nbsp;<span>¥100</span></p>--}}
                            {{--<p>"是个旅游度假的好地方，气候宜人，有很多好玩的地方。海水很清澈.."</p>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="hot_box">--}}
                        {{--<a href="#"><img src="images/huashan.png"></a>--}}
                        {{--<div class="hot_box_introduce">--}}
                            {{--<p>华山&nbsp;&nbsp;--}}
                                {{--<del>¥100</del>--}}
                                {{--&nbsp;&nbsp;<span>¥80</span></p>--}}
                            {{--<p>"奇险天下第一山，西峰绝壁，东峰日出，南峰奇松，北峰云雾，名不..."</p>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="hot_box">--}}
                        {{--<a href="#"><img src="images/zhangjiajie.jpg"></a>--}}
                        {{--<div class="hot_box_introduce">--}}
                            {{--<p>张家界&nbsp;&nbsp;--}}
                                {{--<del>¥130</del>--}}
                                {{--&nbsp;&nbsp;<span>¥80</span></p>--}}
                            {{--<p>"张家界景色很美，门票有点贵，火车站建得太小气了，不过森林公园..."</p>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="hot_box">--}}
                        {{--<a href="#"><img src="images/emeishan.jpg"></a>--}}
                        {{--<div class="hot_box_introduce">--}}
                            {{--<p>峨眉山&nbsp;&nbsp;--}}
                                {{--<del>¥130</del>--}}
                                {{--&nbsp;&nbsp;<span>¥60</span></p>--}}
                            {{--<p>"呼吸着清新的空气，云海和金顶日出非常壮观，就是门票有点贵。东..."</p>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="hot_box">--}}
                        {{--<a href="#"><img src="images/dujiangyan.jpg"></a>--}}
                        {{--<div class="hot_box_introduce">--}}
                            {{--<p>都江堰&nbsp;&nbsp;--}}
                                {{--<del>¥130</del>--}}
                                {{--&nbsp;&nbsp;<span>¥80</span></p>--}}
                            {{--<p>"景区环境好，到成都没有不去都江堰的，真的是古人的奇迹，几千年..."</p>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="hot_box">--}}
                        {{--<a href="#"><img src="images/taishan.jpg"></a>--}}
                        {{--<div class="hot_box_introduce">--}}
                            {{--<p>泰山&nbsp;&nbsp;--}}
                                {{--<del>¥150</del>--}}
                                {{--&nbsp;&nbsp;<span>¥50</span></p>--}}
                            {{--<p>"山上的饭很难吃，住宿很贵，但是景色壮观。沿途风光旖旎，日出和.."</p>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="hot_box">--}}
                        {{--<a href="#"><img src="images/pingyao.jpg"></a>--}}
                        {{--<div class="hot_box_introduce">--}}
                            {{--<p>平遥&nbsp;&nbsp;--}}
                                {{--<del>¥120</del>--}}
                                {{--&nbsp;&nbsp;<span>¥90</span></p>--}}
                            {{--<p>"巍峨的古老城垣厚重深沉，古城内的街道、店铺和民居依旧保持着传..."</p>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>

            </div>
        </div>
    </div>
    <!--底部-->
    <div class="index_footer">

        &copy;2017&nbsp;FootPrint&nbsp;脚印

    </div>
@endsection
