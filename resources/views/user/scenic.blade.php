@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('user.menu')
            <div class="col-md-9">
                <div class="breadcrumb">
                    <a href="/user">我的脚印</a>

                    <span>所有景区</span>
                </div>
                @foreach($list as $item)
                <div class="scenic-list">
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img src="public/images/scenic/wulong1.jpg" alt="" class="media-object">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">{{$item['name']}}</h4>
                            <p>{{$item['info']}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
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