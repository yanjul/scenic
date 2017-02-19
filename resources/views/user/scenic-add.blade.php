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
                <div class="section">
                    <form class="form-horizontal"
                          action="{{ url(isset($data['scenic'])? 'user/update-scenic':'user/add-scenic') }}"
                          method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @if(isset($data['scenic']))
                            <input type="hidden" name="id" value="{{$data['scenic']['id']}}">
                        @endif
                        <ul class="scenic-add">
                            <li>
                                <p class="caption01">景区名字：</p>
                                <div class="info">
                                    <input type="text" class="t" id="scenic-name" name="name"
                                           value="{{isset($data['scenic'])? $data['scenic']['name']: ''}}">
                                    @if ($errors->has('name'))
                                        error
                                    @endif
                                </div>
                            </li>
                            <li>
                                <p class="caption01">景区图片：</p>
                                @if(isset($data['scenic']))
                                    <img src="{{$data['scenic']['image']}}" style="width: 100px">
                                @endif
                                <div class="info">
                                    <input type="file" class="t" id="scenic-image" name="image">
                                </div>
                            </li>
                            <li id="country">
                                <p class="caption01">位置：</p>
                                <div class="info">
                                    <select class="t" id="scenic-country" name="country_id">
                                        @foreach($data['countries'] as $country)
                                            <option value="{{$country['id']}}"
                                                    {{($country['id'] == (isset($data['scenic'])? $data['scenic']['country_id']: 1))? 'selected': ''}}>{{$country['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </li>
                            <li id="place">
                                <p class="caption01">位置：</p>
                                <div class="info">
                                    <select class="t" id="scenic-place" name="place_id">
                                        @foreach($data['place'] as $place)
                                            <option value="{{$place['id']}}"
                                                    {{($place['id'] == (isset($data['scenic'])? $data['scenic']['place_id']: 1))? 'selected': ''}}>{{$place['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </li>
                            @foreach($data['category'] as $key=>$value)
                            <li>
                                <p class="caption01">{{$value['name']}}：</p>
                                <select class="t" name="category[]">
                                    @foreach($value['child'] as $item)
                                        <option value="{{$item['id']}}"
                                        @if(isset($data['scenic']))
                                            @if($key == 0)
                                                {{$data['scenic']['category']['type'] == $item['id']? 'selected': ''}}
                                                    @elseif($key == 1)
                                                {{$data['scenic']['category']['time'] == $item['id']? 'selected': ''}}
                                                    @else
                                                {{$data['scenic']['category']['season'] == $item['id']? 'selected': ''}}
                                                    @endif
                                                @endif
                                        >
                                            {{$item['name']}}
                                        </option>
                                    @endforeach
                                </select>
                            </li>
                            @endforeach
                            <li>
                                <p class="caption01">景区描述：</p>
                                <div class="info">
                                    <textarea name="info" id="" cols="70" rows="6" style="resize: none">{{isset($data['scenic'])? $data['scenic']['info']: ''}}</textarea>
                                </div>
                            </li>
                            <li>
                                <button class="btn btn-success binding" type="submit">{{isset($data['scenic'])? '修改': '添加'}}</button>
                            </li>
                        </ul>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection