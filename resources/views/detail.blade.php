@extends('layouts.app')

@section('css')
    <link href="/css/detail.css" rel="stylesheet">
    <style>
        ._content{
            display: none;
        }
        #sale_menu:hover ._content{
            display: block;
        }
    </style>
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
                        <input type="hidden" name="scenic_id" value="{{$scenic->id}}">
                        @foreach($scenic->ticket as $ticket)
                            <div id="sale_menu" style="border: 1px solid #ff6666">
                                门票：<span style="border: 1px solid #ff9d00">{{$ticket->name}}</span>
                                现价{{$ticket->now_price}}
                                @if($ticket->price != $ticket->now_price)
                                    原价{{$ticket->price}}
                                @endif

                                <input type="number" name="ticket_number[]" min="1" value="1">
                                <input type="checkbox" name="ticket_id[]" value="{{$ticket->id}}" id="checkbox-1" class="checkbox">
                                <label for="checkbox-1" id="checkbox-11" ></label>

                                <div class="_content">
                                    @foreach($ticket->custom_price as $item)
                                        <br />
                                        <span>
                                        {{date('Y-m-d', $item['start_time'])}}至{{date('Y-m-d', $item['end_time'])}}价格<span style="color: brown">{{$item['price']}}</span>元
                                        </span>
                                    @endforeach
                                    <br>
                                    <p>有效天数：{{$ticket->valid_time}}</p>
                                    <p>提前天数：{{$ticket->lead_time}}</p>
                                    <p>最迟天数：{{$ticket->last_time}}</p>
                                    <span>(备注：{{$ticket->remark}})</span>
                                </div>

                            </div>
                        @endforeach
                        <input type="submit" class="btn btn-primary pull-right " value="购买" id="sale_buy" {{Auth::guest()?'':'disable'}} sss>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
//        window.onload = function () {
//            var oMenu=document.getElementById('sale_menu');
//            var oinput=oMenu.getElementsByTagName('input');
//            var oLabel=oMenu.getElementsByTagName('label');
//            var oSale_box=document.getElementById('sale_time_box');
//            var oSale_box_each=oSale_box.getElementsByTagName('div');
//            for(let i=0;i<oLabel.length;i++){
//                 oLabel[i].onclick=function () {
//                     for(let j=0;j<oLabel.length;j++){
//                         oSale_box_each[j].style.display='none';
//                     }
//                     oSale_box_each[i].style.display='block';
//                     oinput[i].className='checkbox';
//                 }
//            }
//        }

    </script>
    <!--景区基本信息-->
    <div class="detail_else">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">景区信息</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
                <h3>基本信息</h3>
                <table class="table table-hover table-bordered">
                    <tr>
                        <td>走进张家界</td>
                        <td>张家界是湖南一个地级市，位于湖南西北部，属武陵山脉腹地，为中国最重要的旅游城市之一。
                            张家界景区共分为四大块：张家界国家森林公园，杨家界自然保护区，天子山自然保护区，索溪峪自然保护区四大景区，统称为武陵源风景名胜区。张家界国家森林公园是中国第一个国家森林公园，景区集神奇、钟秀、雄浑、原始、清新于一体，以岩称奇。园内连绵重叠着数以千计的石峰，奇峰陡峭嵯峨，千姿百态，或孤峰独秀，或群峰相依，造型完美，形神兼备。
                            除武陵源核心景区外，武陵源区有“中华最佳洞府”“地下龙宫”黄龙洞、“人间瑶池”宝峰湖、“江南名刹”普光禅寺、土家人的“圣地”土家风情园等等旅游景点。
                        </td>
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