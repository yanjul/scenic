@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('user.menu')
            <div class="col-md-9">
                <div class="breadcrumb">
                    <a href="/user">我的脚印</a>
                    >
                    <span>景区分销</span>
                </div>
                <div class="scenic-list distribution">
                    <a href="/user/scenic/add-distribution">添加</a>
                    <div class="media">
                        @if(count($list))
                            @foreach($list as $item)
                                <div>
                                    <div class="media-left">
                                        <a href="#" class="imgBox">
                                            <img src="{{$item->scenic->image}}" alt="" class="media-object"
                                                 width="300px"
                                                 height="180px">
                                            <p class="imgTitle">{{$item->scenic->name}}</p>
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading"><a href=""
                                                                     class="scenic-title">{{$item->scenic->name}}</a>
                                        </h4>
                                        <p class="scenic-content">{{$item->scenic->info}}</p>
                                        @foreach($category as $key=>$value)
                                            @foreach($value['child'] as $v)
                                                @if($key == 0 && $v['id'] == $item->scenic->category['type'])
                                                    <span class="des_span des_span01">{{$value['name']}}
                                                        :{{$v['name']}}</span>
                                                @elseif($key == 1 && $v['id'] == $item->scenic->category['time'])
                                                    <span class="des_span des_span02">{{$value['name']}}
                                                        :{{$v['name']}}</span>
                                                @elseif($key == 2 && $v['id'] == $item->scenic->category['season'])
                                                    <span class="des_span des_span03">{{$value['name']}}
                                                        :{{$v['name']}}</span>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </div>
                                    <div class="ticket-desc m-orderList">
                                        <table cellspacing="0" cellpadding="0">
                                            <thead>
                                            <tr>
                                                <th>门票名称</th>
                                                <th>票价</th>
                                                <th>数量</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($item->detail as $detail)
                                                <tr>
                                                    <td>{{$detail->ticket_name}}</td>
                                                    <td>{{$detail->ticket_price}}</td>
                                                    <td>{{$detail->ticket_number}}</td>

                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="3" class="action">
                                                    <a class="btn"
                                                       href="/user/scenic/add-distribution/{{$item->id}}">修改</a>
                                                    <a class="btn"
                                                       href="/user/scenic/del-distribution/{{$item->id}}">删除</a>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <span>暂无</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
