@extends('layouts.app')

@section('content')
    <div class="container">
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
                        <div class="scenic-list">
                            <div class="media">
                                <div class="media-left">
                                    <a href="#" class="imgBox">
                                        <img src="{{$item['image']}}" alt="" class="media-object" width="440px" height="260px">
                                        <p class="imgTitle">{{$item['name']}}</p>
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="" class="scenic-title">{{$item['name']}}</a></h4>
                                    <p class="scenic-content">{{$item['info']}}</p>
                                    <div class="handle">
                                        <p class="edit-btn">
                                            <a href="{{url('user/scenic/'.$item['id'])}}" class="btn btn-primary">查看门票</a>
                                            <a href="{{url('user/add-ticket/'.$item['id'])}}" class="btn btn-success">添加门票</a>
                                            <a href="{{url('user/add-scenic/'.$item['id'])}}" class="btn btn-info btn-3">修改景区</a>
                                            <a href="{{url('user/del-scenic/'.$item['id'])}}" class="btn btn-danger">删除景区</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="scenic-list">

                    </div>

                @endif

                {{--@foreach($list as $item)--}}
                    {{--<div style="border: 2px solid #f0ad4e; display: inline-block; vertical-align: top; width: 240px; height: 240px">--}}
                        {{--<p>{{$item['name']}}</p>--}}
                        {{--<p>--}}
                            {{--<img src="{{$item['image']}}" width="220px">--}}
                        {{--</p>--}}
                        {{--<p>{{$item['info']}}</p>--}}
                        {{--<p>--}}
                            {{--<a href="{{url('user/add-scenic/'.$item['id'])}}">修改</a>--}}
                            {{--<a href="{{url('user/del-scenic/'.$item['id'])}}">删除</a>--}}
                        {{--</p>--}}
                        {{--<p>--}}
                            {{--<a href="{{url('user/scenic/'.$item['id'])}}">查看门票</a>--}}
                            {{--<a href="{{url('user/add-ticket/'.$item['id'])}}">添加门票</a>--}}
                        {{--</p>--}}
                    {{--</div>--}}
                {{--@endforeach--}}
            </div>
        </div>
    </div>

@endsection