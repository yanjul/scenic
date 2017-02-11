@extends('layouts.app')

@section('content')

    <h3>景区</h3><h5><a href="{{url('user/add-scenic')}}">添加</a></h5>
    <div class="container">
        @foreach($list as $item)
            <div style="border: 2px solid #f0ad4e; display: inline-block; vertical-align: top; width: 240px; height: 240px">
                <p>{{$item['name']}}</p>
                <p>
                    <img src="{{$item['image']}}" width="220px">
                </p>
                <p>
                    <a href="{{url('user/add-scenic/'.$item['id'])}}">修改</a>
                    <a href="{{url('user/del-scenic/'.$item['id'])}}">删除</a>
                </p>
                <p>
                    <a href="{{url('user/add-ticket/'.$item['id'])}}">添加门票</a>
                </p>
            </div>
        @endforeach
    </div>

@endsection