@extends('layouts.app')

@section('css')
    <link href="/css/search.css" rel="stylesheet">
@endsection

@section('content')
    <!--内容-->
    <!--主搜索内容-->
    <div class="search_content">
        <div class="search_guess">
            <p>猜您在找</p>
        </div>
        <div class="search_c">
            <img src="images/xgll.png">
            <div class="search_word">
                <h2>香格里拉</h2>
                <p>"这个离天堂最近的地方天空湛蓝，空气清新。有浓郁的藏族文化气息、辽阔的高山草原牧场。火灾之前的月光古城安逸宁静，普达措风景优美，辽阔的纳帕海适合草原骑行，梅里雪山壮观神圣。"</p>
                <p>门票：<span>免费</span></p>
                <p>景区类型：城市</p>
                <p>最佳季节：5-11月。 五月中下旬至八月，是高原草甸上各种花儿争奇斗艳的时候；金秋则是遍地的血色狼毒花，和层林尽染的缤纷秋色。</p>
                <p>建议游玩：3-7天</p>
            </div>
        </div>
    </div>

    <!--搜索分类-->
    <div class="search_classify">
        
        @foreach($category as $item)
           <div class="search_classify_box">
            <ul data-type="{{$item->id ==1? 'type': ($item->id ==2? 'time': 'season')}}">
                <li>{{$item->name}}：</li>
                <li class="{{$item->id ==1? (isset($params['type'])? '':'action'): ($item->id ==2? (isset($params['time'])? '':'action'): (isset($params['season'])? '':'action'))}}" data-id onclick="search(this)"><a href="javascript:">全部</a></li>
                @foreach($item->child as $value)

                    <li data-id="{{$value->id}}" class="{{$value->parent_id ==1? (isset($params['type']) && $params['type'] == $value->id? 'action':''):
                     ($value->parent_id ==2? (isset($params['time']) && $params['time'] == $value->id? 'action':''):
                      (isset($params['season']) && $params['season'] == $value->id? 'action':''))}}" onclick="search(this)"><a href="javascript:">{{$value->name}}</a></li>
                 
                @endforeach
            </ul>
            
        </div>
        @endforeach
        
        @section('js')
        <script>

            function search(el){
                var data_id = el.getAttribute('data-id');
                var data_type = el.parentNode.getAttribute('data-type');
                var params = getParams(location.href);
                params[data_type] = data_id || null;

                location.href = geturl('/search' , params);
              
            }
            function aa(){
                console.log("aaaaaaaaaaaaaaaaaa")
            }
             function geturl(baseUrl, obj) {
                var url = baseUrl + '?';
                for (var attr in obj) {
                    if(obj[attr] !== null ) {
                        url += attr + '=' + obj[attr].replace(/^(\s+)|(\s+)$/g, '') + '&';
                    }
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
                        params[arr[i].split('=')[0]] = arr[i].split('=')[1] || '';
                    }
                    return params;
                } else {
                    return {};
                }
            }
            </script>
        @endsection

        
    </div>

    <!--其他搜索-->
    <div class="search_else_box">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab"
                                                      data-toggle="tab">按相关度</a></li>
            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">按热门</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="home">
                @if(count($scenic['data']))
                    @foreach($scenic['data'] as $item)
                    <div class="search_else">
                        <div class="search_else_word">
                            <h2>{{$item['name']}}</h2>
                            <p>{{$item['info']}}</p>
                        
                            <p>景区类型：{{ $cate[$item['category']['type']] }}</p>
                            <p>最佳季节：{{ $cate[$item['category']['season']] }}</p>
                            <p>建议游玩：{{ $cate[$item['category']['time']] }}</p>
                        </div>
                        <img src="{{$item['image']}}">
                    </div>

                    @endforeach
                    @if(true)
                        <div class="page">
                            <!--<div class="prev">-->
                            <a href="{{$scenic['prev_page_url']}}">上一页</a>
                            <!--</div>-->
                            <!--<div class="num">-->
                                @for($i = ($scenic['current_page']-2<1?1 : $scenic['current_page']-2); $i<= ($scenic['current_page'] + 2>$scenic['last_page']?$scenic['last_page']:$scenic['current_page'] + 2); $i ++)
                                    <a class="{{$scenic['current_page']==$i?'selected':''}}" onclick="aa()">{{$i}}</a>
                                @endfor
                            <!--</div>-->
                            <!--<div class="next">-->
                            <a href="{{$scenic['next_page_url']}}">下一页</a>
                            <!--</div>-->
                        </div>
                    @endif
                @else
                    <p class="null">没有你要搜索的内容</p>
                @endif
               
                <div class="search_else">
                    <div class="search_else_word">
                        <h2>九寨沟</h2>
                        <p>"九寨沟，因沟内有九个藏族寨子而得名。中国最美的水景，美丽的童话世界。在九寨沟内的藏族古寨里体验藏族风情也为一大特色。"</p>
                        <p>门票：<span>旺季（04月01日~11月15日）：220.00元 淡季（11月16日~03月31日）：80.00元</span></p>
                        <p>景区类型：自然保护区</p>
                        <p>最佳季节：9月-10月最佳。 深秋11月是九寨沟最为灿烂的时期，清空湛碧，红叶、彩林倒映在明丽的湖水中绚丽多彩。但这一时期是旺季，恰遇国庆假日，游人很多，建议避开放假。 </p>
                        <p>建议游玩：1-3天</p>
                    </div>
                    <img src="images/jiuzhaigou.jpg">
                </div>
            </div>
        </div>

         



    </div>

    <!--底部-->
    <div class="index_footer">
        &copy;2017&nbsp;FootPrint&nbsp;脚印
    </div>
@endsection