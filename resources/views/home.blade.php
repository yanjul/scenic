@extends('layouts.app')

@section('css')
    <link href="/css/index.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="top_left">
                <h2 class="top_left_title">景区等级分类</h2>
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-success">AAAAA级</a>
                    <a href="#" class="list-group-item list-group-item-info">AAAA级</a>
                    <a href="#" class="list-group-item list-group-item-warning">AAA级</a>
                    <a href="#" class="list-group-item list-group-item-danger">AA级</a>
                    <a href="#" class="list-group-item list-group-item-primary">A级</a>
                </div>
                <h2 class="top_left_title">热门景区</h2>
                <div class="list-group">
                    <button type="button" class="list-group-item">九寨沟</button>
                    <button type="button" class="list-group-item">青龙瀑布</button>
                    <button type="button" class="list-group-item">济州岛</button>
                </div>
            </div>
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
                            <img src="/images/system/img1.jpg" alt="...">
                            <div class="carousel-caption">

                            </div>
                        </div>
                        <div class="item">
                            <img src="/images/system/img2.jpg" alt="...">
                            <div class="carousel-caption">

                            </div>
                        </div>
                        <div class="item">
                            <img src="/images/system/ximg3.jpeg" alt="...">
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

            <!--内容-->
            <div class="content">
                <ul id="myTab" class="nav nav-tabs">
                    <li class="active">
                        <a href="#home" data-toggle="tab">
                            九寨沟
                        </a>
                    </li>
                    <li><a href="#ios" data-toggle="tab">青龙瀑布</a></li>
                    <li class="dropdown">
                        <a href="#" id="myTabDrop1" class="dropdown-toggle"
                           data-toggle="dropdown">济州岛
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1">
                            <li><a href="#jmeter" tabindex="-1" data-toggle="tab">first</a></li>
                            <li><a href="#ejb" tabindex="-1" data-toggle="tab">second</a></li>
                        </ul>
                    </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade in active" id="home">
                        <p>九寨沟</p>
                    </div>
                    <div class="tab-pane fade" id="ios">
                        <p>青龙瀑布</p>
                    </div>
                    <div class="tab-pane fade" id="jmeter">
                        <p>济州岛1</p>
                    </div>
                    <div class="tab-pane fade" id="ejb">
                        <p>济州岛2</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
