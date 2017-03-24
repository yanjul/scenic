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
                    <form id="form" action="/order/create" method="post">
                        <input type="hidden" name="scenic_id" value="{{$scenic->id}}">
                        @foreach($scenic->ticket as $key=>$ticket)
                            <div id="sale_menu">
                                <div class="or_menu" id="or22">
                                    <div class="or_menpiao clearfix">
                                        门票：<span style="color:limegreen">{{$ticket->name}}</span>
                                    </div>
                                    <div class="or_xianjia ">现价：<span
                                                style="color: #2e6da4">{{$ticket->now_price}}</span></div>
                                    <div class="or_yuanjia">
                                        @if($ticket->price != $ticket->now_price)
                                            <del> 原价：{{$ticket->price}}</del>
                                        @endif
                                    </div>
                                        @if($ticket->number>=0)
                                    <div class="or_yuliang">
                                        门票余量：<span>{{$ticket->number}}</span>
                                    </div>
                                        @endif
                                    <div class="or_kuang">
                                        <div class="math">
                                            <span class="minus" onclick="minus( {{$key}} )">-</span>
                                            <span class="input_num">
                                                <input id="num{{$key}}" type="text" value="1" readonly/>
                                            </span>
                                            <span class="add" onclick="add( {{$key}} )">+</span>
                                        </div>
                                        <input type="checkbox" onchange="check(this.parentNode)" name="ticket_id[]" value="{{$ticket->id}}" id="checkbox-1" class="checkbox ">
                                        @section('js')
                                            <script>
                                                function minus(ind) {
                                                    var index = ind;
                                                    var id = 'num' + index;
                                                    document.getElementById(id).value--;
                                                    if (document.getElementById(id).value <= 1) {
                                                        document.getElementById(id).value = 1;
                                                    }
                                                }
                                                function add(ind) {
                                                    var index = ind;
                                                    var id = 'num' + index;
                                                    document.getElementById(id).value++;
                                                }
                                                function check(el) {
                                                   var input = $(el).find('input[type="text"]').eq(0);
                                                   if(input.attr('name')) {
                                                       input.attr('name', '')
                                                   } else {
                                                       input.attr('name', 'ticket_number[]')
                                                   }
                                                }
                                                function _submit(_this) {
                                                    var form = document.querySelector('#form');
                                                    if (parseInt($(_this).attr('action'))) {
                                                        form.setAttribute('action', '/order/create')
                                                    } else {
                                                        form.setAttribute('action', '/order/reserve')
                                                    }
                                                    form.submit();
                                                }
                                            </script>
                                        @endsection
                                    </div>
                                </div>
                                <div class="_content">
                                    @foreach($ticket->custom_price as $item)
                                        <br/>
                                        <span>
                                        {{date('Y-m-d', $item['start_time'])}}至{{date('Y-m-d', $item['end_time'])}}
                                            价格：<span style="color:#FF4949">{{$item['price']}}</span>元
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
                        <div class="row ">
                            <button action="0" onclick="_submit(this)" type="button" class="btn btn-info " style="margin-left: 60%">预定
                            </button>
                            <button action="1" onclick="_submit(this)" type="button" class="btn btn-info pull-right">立即购买
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--景区基本信息-->
    <div class="detail_else">

        <!-- Nav tabs -->
        {{--<ul class="nav nav-tabs" role="tablist">
            <li  role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">景区信息</a>
            </li>
        </ul>--}}
        <div class="progress">
            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 30%;font-size: 20px">
                景区信息
            </div>
        </div>
        <!-- Tab panes -->
        <div class="tab-content">

            <div class="jumbotron" style="font-size: 17px;box-shadow: 0 0 10px gray;letter-spacing: 3px">{{$scenic->info}}</div>

        </div>
    </div>

    <!--底部-->
    @include('user.footer')
@endsection