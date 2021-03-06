@extends('layouts.app')

@section('content')
    <div class="container main" style="min-height: 830px;">
        <div class="row">
            @include('user.menu')
            <div class="col-md-9">
                <div class="breadcrumb">
                    <a href="/user">我的脚印</a>
                    >
                    <span>所有景区</span>
                </div>
                @if(count($list))
                    @foreach($list as $item)
                        <div class="scenic-list scenicShow" style="position: relative">
                            @if($item['status'] == 3)
                                <div style="position: absolute; left: 0; right: 0; top: 0; bottom: 0; z-index: 10; background-color: rgba(220, 220, 220, .4)"></div>
                            @endif
                            <div class="media">
                                <div class="media-left">
                                    <a href="#" class="imgBox">
                                        <img src="{{$item['image']}}" alt="" class="media-object" width="440px"
                                             height="260px">
                                        <p class="imgTitle">{{$item['name']}}</p>
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="" class="scenic-title">{{$item['name']}}</a></h4>
                                    <p class="scenic-content">{{$item['info']}}</p>
                                    <div class="des_div">
                                        @foreach($category as $key=>$value)
                                            @foreach($value['child'] as $v)
                                                @if($key == 0 && $v['id'] == $item['category']['type'])
                                                    <span class="des_span des_span01">{{$value['name']}}
                                                        :{{$v['name']}}</span>
                                                @elseif($key == 1 && $v['id'] == $item['category']['time'])
                                                    <span class="des_span des_span02">{{$value['name']}}
                                                        :{{$v['name']}}</span>
                                                @elseif($key == 2 && $v['id'] == $item['category']['season'])
                                                    <span class="des_span des_span03">{{$value['name']}}
                                                        :{{$v['name']}}</span>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </div>
                                    <div class="handle">
                                        <p class="edit-btn">
                                            <a href="{{url('user/scenic/'.$item['id'])}}"
                                               class="btn btn-primary btn-sm">查看门票</a>
                                            <a href="{{!$item['parent_id']? '/user/add-ticket/'.$item['id']: 'javascript:'}}"
                                               {{!$item['parent_id']? '': 'disabled'}} class="btn btn-success btn-sm">添加门票</a>
                                            <a href="{{!$item['parent_id']? '/user/add-scenic/'.$item['id']:'javascript:'}}"
                                               {{!$item['parent_id']? '': 'disabled'}}
                                               class="btn btn-info btn-sm btn-3">修改景区</a>
                                            <a href="{{!$item['parent_id']? '/user/del-scenic/'.$item['id']:'javascript:'}}"
                                               {{!$item['parent_id']? '': 'disabled'}} class="btn btn-danger btn-sm">删除景区</a>
                                            @if($item['status'] == 1)
                                                <a href="/user/scenic/status?id={{$item['id']}}&status=0"
                                                   class="btn btn-danger btn-sm">下架</a>
                                            @elseif($item['status'] == 0)
                                                <a href="/user/scenic/status?id={{$item['id']}}&status=1"
                                                   class="btn btn-success btn-sm">上架</a>
                                            @else
                                                <a href="javascript:" title="已被强制下架" disabled
                                                   class="btn btn-danger btn-sm">上架</a>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="section no-scenic">
                        亲！当前没有任何景区，赶紧去 <a href="/user/add-scenic" class="c4">添加景区</a> 吧。
                    </div>

                @endif
            </div>
        </div>
    </div>
    @include('user.footer')
@endsection
