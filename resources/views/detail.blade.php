@extends('layouts.app')

@section('css')
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
            <div class="detail_pic" >
                <img src="{{$scenic->image}}">
            </div>
            <div class="detail_word">
                <div class="detail_word_head">
                    <h2>{{$scenic->name}}</h2>
                    <p>
                        <span>门票：</span>
                    </p>
                    @foreach($scenic->ticket as $ticket)
                        <p>
                            <span>门票名字：{{$ticket->name}}</span>
                            <span>价格：{{$ticket->now_price}}</span>
                            @if($ticket->price != $ticket->now_pice)
                                <span>原价：{{$ticket->price}}</span>
                            @endif
                            @foreach($ticket->custom_price as $item)
                                <br />
                                <span>
                                {{date('Y-m-d', $item['start_time'])}}
                                <-->
                                {{date('Y-m-d', $item['end_time'])}}
                                <-->
                                {{$item['price']}}
                                </span>
                            @endforeach
                            <span>备注：{{$ticket->remark}}</span>
                            <input type="checkbox" id="checkbox-1">
                            <label for="checkbox-1"></label>
                        </p>
                    @endforeach

                    <p>
                        <input type="submit" class="btn btn-primary pull-right" value="购买">
                    </p>
                </div>

            </div>
        </div>
    </div>

    <!--景区基本信息-->
    <div class="detail_else">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">景区信息</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
                <h3>基本信息</h3>
                <table class="table table-hover table-bordered">
                    <tr>
                        <td width="10%">大家印象</td>
                        <td>张家界景色很美，门票有点贵，火车站建得太小气了，不过森林公园太赞了，它美妙得展现了大自然的美丽，雄伟的山峰直插云霄。森林公园里环境优美，空气很清新，是真正的大自然风光。</td>
                    </tr>
                    <tr>
                        <td>走进张家界</td>
                        <td>张家界是湖南一个地级市，位于湖南西北部，属武陵山脉腹地，为中国最重要的旅游城市之一。 张家界景区共分为四大块：张家界国家森林公园，杨家界自然保护区，天子山自然保护区，索溪峪自然保护区四大景区，统称为武陵源风景名胜区。张家界国家森林公园是中国第一个国家森林公园，景区集神奇、钟秀、雄浑、原始、清新于一体，以岩称奇。园内连绵重叠着数以千计的石峰，奇峰陡峭嵯峨，千姿百态，或孤峰独秀，或群峰相依，造型完美，形神兼备。 除武陵源核心景区外，武陵源区有“中华最佳洞府”“地下龙宫”黄龙洞、“人间瑶池”宝峰湖、“江南名刹”普光禅寺、土家人的“圣地”土家风情园等等旅游景点。</td>
                    </tr>
                    <tr>
                        <td>最佳季节</td>
                        <td>3-5、9-11月。春天的张家界芳草茵茵，溯金鞭溪，游十里画廊，探黄龙洞，可以体会武陵人进入桃花源的惊喜；秋天的张家界层林尽染，正是猕猴桃、蜜橘等水果成熟的时节。相对而言，夏季高温多雨，冬季气候寒冷，舒适度稍逊于春秋。</td>
                    </tr>
                    <tr>
                        <td>建议游玩</td>
                        <td>2-3天</td>
                    </tr>
                </table>
            </div>

        </div>
    </div>

    <!--底部-->
    <div class="index_footer">
        &copy;2017&nbsp;FootPrint&nbsp;脚印
    </div>
@endsection