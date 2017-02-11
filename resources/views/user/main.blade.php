@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="/css/user/main.css">
@endsection
@section('content')

    <div class="container main">
        <div class="row">
            @include('user.menu')
        </div>
    </div>



@endsection