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
                        <input type="hidden" name="scenic_id" value="{{$scenic->id}}">
                        @foreach($scenic->ticket as $key=>$ticket)
                            <div id="sale_menu" >
                                <div class="or_menu" >
                                    <div class="or_menpiao clearfix">
                                        门票：<span style="color:limegreen">{{$ticket->name}}</span>
                                    </div>
                                    <div class="or_xianjia " >现价：<span style="color: #2e6da4">{{$ticket->now_price}}</span></div>
                                    <div class="or_yuanjia">
                                        @if($ticket->price != $ticket->now_price)
                                            原价：{{$ticket->price}}
                                        @endif
                                    </div>
                                    <div class="or_kuang">
                                        <div class="math">
                                            <span class="minus" onclick="minus( {{$key}} )">-</span>
                                            <!-- <input type="number" class="num" name="ticket_number[]" min="1" value="1"  style="width: 50px;margin-left: 40px">-->
                                            <span class="input_num"><input name="ticket_number[]"  id="num{{$key}}" type="text" value="1" readonly/></span>
                                            <span class="add" onclick="add( {{$key}} )">+</span>
                                        </div>
                                        <input type="checkbox" name="ticket_id[]" value="{{$ticket->id}}" id="checkbox-1" class="checkbox ">
                                        @section('js')
                                            <script>
                                                function minus(ind){
                                                    var index = ind; 
                                                    var id = 'num'+index;
                                                   document.getElementById(id).value--;
                                                   if(document.getElementById(id).value<=1){
                                                       document.getElementById(id).value = 1;
                                                   }
                                                }
                                                function add(ind){
                                                    var index = ind; 
                                                    var id = 'num'+index;
                                                    document.getElementById(id).value ++;
                                                    if(document.getElementById(id).value >3){
                                                        document.getElementById(id).value = 3;
                                                        alert("购买数量大于3");
                                                    }
                                                }
                                            </script>
                                        @endsection
                                    </div>
                                </div>
                                <div class="_content">
                                    @foreach($ticket->custom_price as $item)
                                        <br />
                                        <span>
                                        {{date('Y-m-d', $item['start_time'])}}至{{date('Y-m-d', $item['end_time'])}}价格：<span style="color:#FF4949">{{$item['price']}}</span>元
                                        </span>
                                    @endforeach
                                    <br><br>
                                    <span>有效天数：<span style="color: #FF4949">{{$ticket->valid_time}}</span></span>
                                    <span>提前天数：<span style="color: #FF4949">{{$ticket->lead_time}}</span></span>
                                    <span>最迟天数：<span style="color: #FF4949">{{$ticket->last_time}}</span></span>
                                    <span>(备注：{{$ticket->remark}})</span>
                                </div>
                            </div>
                            <br>
                        @endforeach
                        <input type="submit" class="btn btn-info pull-right" value="立即购买" id="sale_buy"  >
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