@extends('layouts.app')

@section('css')
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/detail.css" rel="stylesheet">

@endsection

@section('content')
    <!--商品详情内容-->
    <div class="detail_content clearfix">
        <div class="detail_head">
            <ul>
                <li><a href="#">脚印</a></li>
                <li><a href="#"> > </a></li>
                <li><a href="#">{{$scenic->name}}</a></li>
            </ul>
        </div>
        <div class="detail_main clearfix">
            <div class="detail_pic">
                <img src="{{$scenic->image}}">
            </div>
            <div class="detail_word">
                <div class="detail_word_head">
                    <h2>{{$scenic->name}}</h2>
                    <form action="/order/create" method="post">
                        @foreach($scenic->distribution as $distribution)
                            <div id="sale_menu">
                                <div><span>名称</span><b>{{$distribution->package_name}}</b></div>
                                @foreach($distribution->detail as $detail)
                                    <div class="or_menu">
                                        <div class="or_menpiao clearfix">
                                            门票名称：<span style="color:limegreen">{{$detail->ticket_name}}</span>
                                        </div>
                                        <div class="or_xianjia ">
                                            价格：<span style="color: #2e6da4">{{$detail->ticket_price}}</span>
                                        </div>
                                        <div class="or_kuang">
                                            数量：<span style="color: #2e6da4">{{$detail->ticket_number}}</span>
                                        </div>
                                    </div>
                                @endforeach
                                <input type="radio" name="distribution_id" value="{{$distribution->id}}">
                            </div>
                        @endforeach
                        <input type="submit" disabled class="btn btn-info pull-right" value="立即购买" id="sale_buy">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--景区基本信息-->
    <div class="detail_else">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">景区信息</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">

            <div>{{$scenic->info}}</div>

        </div>
    </div>

    <!--底部-->
    <div class="index_footer">
        &copy;2017&nbsp;FootPrint&nbsp;脚印
    </div>
@endsection