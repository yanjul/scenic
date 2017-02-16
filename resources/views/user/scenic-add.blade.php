@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('user.menu')
            <div class="col-md-9">
                <div class="breadcrumb">
                    <a href="/user">我的脚印</a>

                    <span>景区添加</span>
                </div>
                <form class="form-horizontal" action="{{ url(isset($data['scenic'])? 'user/update-scenic':'user/add-scenic') }}"
                      method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @if(isset($data['scenic']))
                        <input type="hidden" name="id" value="{{$data['scenic']['id']}}">
                    @endif
                    <div class="form-group">
                        <label class="control-label" for="scenic-name">景区名字</label>
                        <input class="form-control" type="text" id="scenic-name" name="name"
                               value="{{isset($data['scenic'])? $data['scenic']['name']: ''}}">
                        @if ($errors->has('name'))
                            error
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="scenic-image">景区图片</label>
                        @if(isset($data['scenic']))
                            <img src="{{$data['scenic']['image']}}" style="width: 100px">
                        @endif
                        <input class="form-control" type="file" id="scenic-image" name="image">
                    </div>
                    <div id="country" class="form-group">
                        <label for="scenic-country">位置</label>
                        <select class="form-control" id="scenic-country" name="country_id">
                            @foreach($data['countries'] as $country)
                                <option value="{{$country['id']}}"
                                        {{($country['id'] == (isset($data['scenic'])? $data['scenic']['country_id']: 1))? 'selected': ''}}>{{$country['name']}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div id="place" class="form-group">
                        <label for="scenic-place">位置</label>
                        <select class="form-control" id="scenic-place" name="place_id">
                            @foreach($data['place'] as $place)
                                <option value="{{$place['id']}}"
                                        {{($place['id'] == (isset($data['scenic'])? $data['scenic']['place_id']: 1))? 'selected': ''}}>{{$place['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="scenic-image">景区描述</label>
                        <textarea class="form-control" name="info">{{isset($data['scenic'])? $data['scenic']['info']: ''}}</textarea>
                    </div>
                    <button class="btn" type="submit">{{isset($data['scenic'])? '修改': '添加'}}</button>
                </form>
            </div>
        </div>
    </div>
@endsection