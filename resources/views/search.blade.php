@extends('layouts.app')

@section('css')
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/search.css" rel="stylesheet">
@endsection

@section('content')
    <div class="index_search clearfix">
        <div class="logo">
            <p style="font-size: 60px">👣</p>
            <p>FootPrint脚印</p>
        </div>
        <div class="search_box">
            <form action="">
                <div class="form-group">
                    <label for="search"></label>
                    <input type="text" id="search" name="search" placeholder="请输入景区名称">
                    <div id="search_w" onclick="search()">搜索</div>
                    <script>
                        var params = getParams(location.href);
                        document.getElementById("search").setAttribute('value', params.keyword || '');
                        function search() {
                            var keywords = document.getElementById("search").value;
                            var url = geturl('/search', {keyword: keywords});
                            location.href = url;
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
                                for (var i = 0; i < arr.length; i++) {
                                    params[arr[i].split('=')[0]] = arr[i].split('=')[1];
                                }
                                return params;
                            } else {
                                return {};
                            }
                        }
                    </script>
                </div>
            </form>
        </div>
    </div>
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
    </div>
    <!--其他搜索-->
    <div class="search_else_box">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab"
                                                      data-toggle="tab">景区</a></li>
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
                    @if(count($scenic['urls']))
                        <div class="container-fluid" >
                            <div class="row col-md-12" style="display: flex;justify-content: center">
                                <nav aria-label="Page navigation" >
                                    <ul class="pagination">
                                        <li>
                                            <a href="{{$scenic['prev_page_url']}}" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                        @foreach($scenic['urls'] as $key=>$value)
                                            <li class="{{$key==$scenic['current_page']?'active':''}}">
                                                <a href="{{$key==$scenic['current_page']? '': $value}}">{{$key}}</a>
                                            </li>

                                        @endforeach

                                        <li>
                                            <a href="{{$scenic['next_page_url']}}" aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>

                    @endif
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