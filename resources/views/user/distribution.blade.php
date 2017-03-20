@extends('layouts.app')

@section('content')
    <div class="container" style="min-height: 830px;">
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
                    @if(count($list))
                        @foreach($list as $item)
                    <div class="media">
                        <div style="margin-bottom: 10px;">
                            <div class="media-left">
                                <a href="#" class="imgBox">
                                    <img src="{{$item->image}}" alt="" class="media-object"
                                         width="300px"
                                         height="180px">
                                    <p class="imgTitle">{{$item->name}}</p>
                                </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    <a href="" class="scenic-title">{{$item->name}}</a>
                                </h4>
                                <p class="scenic-content">{{$item->info}}</p>
                                <div class="typeList">
                                    @foreach($category as $key=>$value)
                                        @foreach($value['child'] as $v)
                                            @if($key == 0 && $v['id'] == $item->category['type'])
                                                <span class="des_span des_span01">{{$value['name']}}
                                                    :{{$v['name']}}</span>
                                            @elseif($key == 1 && $v['id'] == $item->category['time'])
                                                <span class="des_span des_span02">{{$value['name']}}
                                                    :{{$v['name']}}</span>
                                            @elseif($key == 2 && $v['id'] == $item->category['season'])
                                                <span class="des_span des_span03">{{$value['name']}}
                                                    :{{$v['name']}}</span>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </div>
                            </div>
                            @foreach($item->distribution as $distribution)
                                <div class="ticket-desc m-orderList" style="margin-top: 0">
                                    <div style="margin-bottom: 15px;">
                                        <span>标题：</span>
                                        <b>{{$distribution->package_name}}</b>
                                    </div>
                                    <table cellspacing="0" cellpadding="0" style="margin-bottom: 0">
                                        <thead>
                                        <tr>
                                            <th>门票名称</th>
                                            <th>票价</th>
                                            <th>数量</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($distribution->detail as $detail)
                                            <tr>
                                                <td>{{$detail->ticket_name}}</td>
                                                <td style="color: #ff8a00">{{$detail->ticket_price}}</td>
                                                <td>{{$detail->ticket_number}}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="3" class="action" style="text-align: right;padding-bottom: 4px">
                                                <a class="btn" style="font-weight:normal"
                                                   href="/user/scenic/add-distribution/{{$distribution->id}}">修改</a>
                                                <a class="btn" style="font-weight:normal"
                                                   href="/user/scenic/del-distribution/{{$distribution->id}}">删除</a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                    @else
                        <div class="media">
                            <span>暂无</span>
                        </div>

                    @endif
                </div>
            </div>
        </div>
    </div>
    @include('user.footer')
@endsection
