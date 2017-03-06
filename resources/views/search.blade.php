@extends('layouts.app')

@section('css')
    <link href="/css/search.css" rel="stylesheet">
@endsection

@section('content')
    <!--搜索分类-->
    <div class="search_classify">
        @foreach($category as $item)
            <div class="search_classify_box">
                <ul data-type="{{$item->id ==1? 'type': ($item->id ==2? 'time': 'season')}}">
                    <li>{{$item->name}}：</li>
                    <li class="{{$item->id ==1? (isset($params['type'])? '':'action'): ($item->id ==2? (isset($params['time'])? '':'action'): (isset($params['season'])? '':'action'))}}"
                        data-id onclick="search(this)"><a href="javascript:">全部</a></li>
                    @foreach($item->child as $value)
                        <li data-id="{{$value->id}}" class="{{$value->parent_id ==1? (isset($params['type']) && $params['type'] == $value->id? 'action':''):
                     ($value->parent_id ==2? (isset($params['time']) && $params['time'] == $value->id? 'action':''):
                      (isset($params['season']) && $params['season'] == $value->id? 'action':''))}}"
                            onclick="search(this)"><a href="javascript:">{{$value->name}}</a></li>

                    @endforeach
                </ul>

            </div>
        @endforeach
        @section('js')
            <script>
                function search(el) {
                    var data_id = el.getAttribute('data-id');
                    var data_type = el.parentNode.getAttribute('data-type');
                    var params = getParams(location.href);
                    params[data_type] = data_id || null;
                    location.href = geturl('/search', params);
                }
                function geturl(baseUrl, obj) {
                    var url = baseUrl + '?';
                    for (var attr in obj) {
                        if (obj[attr] !== null) {
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
                        for (var i = 0; i < arr.length; i++) {
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
                    <div class="page">
                        <a href="{{$scenic['prev_page_url']}}">上一页</a>
                        @foreach($scenic['urls'] as $key=>$value)
                            <a href="{{$key==$scenic['current_page']? '': $value}}"
                               class="{{$key==$scenic['current_page']?'selected':''}}">{{$key}}</a>
                        @endforeach
                        <a href="{{$scenic['next_page_url']}}">下一页</a>
                    </div>
                @else
                    <p class="null">没有你要搜索的内容</p>
                @endif
            </div>
        </div>
    </div>
    <!--底部-->
    <div class="index_footer">
        &copy;2017&nbsp;FootPrint&nbsp;脚印
    </div>
@endsection