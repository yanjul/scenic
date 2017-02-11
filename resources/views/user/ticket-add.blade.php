@extends('layouts.app')

@section('content')
    <h3>添加门票</h3>
    <div class="container">
        <div>
            <h4>景区名字</h4>
            <img src="{{$scenic['image']}}" height="200">
        </div>
        <form class="form-horizontal"
              action="{{isset($scenic['ticket'])? '/user/scenic/ticket/'.$scenic['ticket']['id'] : '/user/add-ticket' }}"
              method="post">
            {{ csrf_field() }}
            <input type="hidden" name="scenic_id" value="{{$scenic['id']}}">
            <div class="form-group">
                <label class="control-label" for="ticket-name">门票名称</label>
                <input class="form-control" type="text" id="ticket-name" name="name"
                       value="{{isset($scenic['ticket'])? $scenic['ticket']['name']: ''}}">
                @if ($errors->has('name'))
                    error
                @endif
            </div>
            <div class="form-group">
                <label class="control-label" for="ticket-price">门票价格</label>
                <input class="form-control" type="number" id="ticket-price" name="price"
                       value="{{isset($scenic['ticket'])? $scenic['ticket']['price']: ''}}">
                @if ($errors->has('name'))
                    error
                @endif
            </div>
            <div id="custom-price" class="form-group">
                <label class="control-label" for="ticket-name">自定义价格</label>
                @if(isset($scenic['ticket']) && count($scenic['ticket']))
                    @foreach($scenic['ticket']['custom_price'] as $ticket)
                        <div>
                            <input type="date" name="start_time[]" value="{{date('Y-m-d', $ticket['start_time']-1)}}"
                                   placeholder="开始时间">---
                            <input type="date" name="end_time[]" value="{{date('Y-m-d', $ticket['end_time']-1)}}"
                                   placeholder="结束时间">
                            <input type="tel" name="custom_price[]" value="{{$ticket['price']}}" placeholder="价格">
                            <button class="btn del" type="button" onclick="delNode(this)">删除</button>
                        </div>
                    @endforeach
                @else
                    <div>
                        <input type="date" name="start_time[]" placeholder="开始时间">---
                        <input type="date" name="end_time[]" placeholder="结束时间">
                        <input type="tel" name="custom_price[]" placeholder="价格">
                        <button class="btn del" type="button" onclick="delNode(this)">删除</button>
                    </div>
                @endif
                <button class="btn" type="button" onclick="addNode(this)">添加</button>
                <script>
                    function addNode(node) {
                        var element = document.querySelectorAll('#custom-price>div');
                        if (element) {
                            node.parentNode.insertBefore(element[element.length - 1].cloneNode(true), node)
                        }
                    }
                    function delNode(node) {
                        var element = document.querySelectorAll('#custom-price > div');
                        if (element.length > 1) {
                            node.parentNode.parentNode.removeChild(node.parentNode);
                        } else {
                            element[0].children[0].value = '';
                            element[0].children[1].value = '';
                            element[0].children[2].value = '';
                        }
                    }
                </script>
            </div>

            <div class="form-group">
                <label class="control-label" for="ticket-valid-time">门票有效时间</label>
                <input class="form-control" type="tel" pattern="^[0-9]+$" id="ticket-valid-time" name="valid_time"
                       value="{{isset($scenic['ticket'])? $scenic['ticket']['valid_time']: ''}}">
                @if ($errors->has('name'))
                    error
                @endif
            </div>
            <div class="form-group">
                <label class="control-label" for="ticket-lead-time">门票提前时间</label>
                <input class="form-control" type="tel" pattern="^[0-9]+$" id="ticket-lead-time" name="lead_time"
                       value="{{isset($scenic['ticket'])? $scenic['ticket']['lead_time']: ''}}">
                @if ($errors->has('name'))
                    error
                @endif
            </div>
            <div class="form-group">
                <label class="control-label" for="ticket-last-time">门票最迟时间</label>
                <input class="form-control" type="tel" pattern="^[0-9]+$" id="ticket-last-time" name="last_time"
                       value="{{isset($scenic['ticket'])? $scenic['ticket']['last_time']: ''}}"
                       placeholder="0-24">
                @if ($errors->has('name'))
                    error
                @endif
            </div>
            <button class="btn" type="submit">{{isset($scenic['ticket'])? '修改': '添加'}}</button>
        </form>
    </div>
@endsection