@extends('layouts.app')

@section('content')
    <h3>添加景区</h3>

    <form action="{{ url('user/add-scenic') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <label for="scenic-name">景区名字</label>
        <input type="text" id="scenic-name" name="name">
        <br/>
        <label for="scenic-image">景区图片</label>
        <input type="file" id="scenic-image" name="image">

        <button type="submit">添加</button>
    </form>
@endsection