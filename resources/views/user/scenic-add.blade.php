@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('user.menu')
        <div class="col-md-9">
            <div class="breadcrumb">
                <a href="/user">我的脚印</a>
                >
                <span>景区添加</span>
            </div>
            <form class="form-horizontal" action="{{ url($data? 'user/update-scenic':'user/add-scenic') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                @if($data)
                    <input type="hidden" name="id" value="{{$data['id']}}">
                @endif
                <div class="form-group">
                    <label class="control-label" for="scenic-name">景区名字</label>
                    <input class="form-control" type="text" id="scenic-name" name="name" value="{{$data? $data['name']: ''}}">
                    @if ($errors->has('name'))
                        error
                    @endif
                </div>
                <div class="form-group">
                    <label for="scenic-image">景区图片</label>
                    @if($data)
                        <img src="{{$data['image']}}" style="width: 100px">
                    @endif
                    <input class="form-control" type="file" id="scenic-image" name="image">
                </div>
                <div class="form-group">
                    <label for="scenic-image">景区描述</label>
                    <textarea class="form-control" name="info">{{$data? $data['info']: ''}}</textarea>
                </div>
                <button class="btn" type="submit">{{$data? '修改': '添加'}}</button>
            </form>
        </div>
    </div>
</div>

@endsection