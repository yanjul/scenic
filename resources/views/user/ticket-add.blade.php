@extends('layouts.app')

@section('content')
    <div class="container" style="min-height: 830px;">
        <div class="row">
            @include('user.menu')
            <div class="col-md-9">
                <div class="breadcrumb">
                    <a href="/user">我的脚印</a>
                    >
                    <span>门票添加</span>
                </div>
                <div class="section">
                    <form class="form-horizontal"
                          action="{{isset($scenic['ticket'])? '/user/scenic/ticket/'.$scenic['ticket']['id'] : '/user/add-ticket' }}"
                          method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="scenic_id" value="{{$scenic['id']}}">
                        <ul class="ticket-add">
                            <li>
                                <p class="caption01">景区名字：</p>
                                <div class="info">
                                    <span class="scenic-name">{{$scenic['name']}}</span>
                                </div>
                            </li>
                            <li>
                                <p class="caption01">景区图片：</p>
                                <div class="info">
                                    <img src="{{$scenic['image']}}" height="120">
                                </div>
                            </li>
                            <li>
                                <p class="caption01">门票名称：</p>
                                <div class="info">
                                    <input type="text" class="t" id="ticket-name" name="name"
                                           value="{{isset($scenic['ticket'])? $scenic['ticket']['name']: ''}}">
                                    @if ($errors->has('name'))
                                        <span class="warningTips">门票名称不能为空!</span>
                                    @endif
                                </div>
                            </li>
                            <li>
                                <p class="caption01">门票底价：</p>
                                <div>
                                    <input class="t" type="number" id="ticket-price" name="floor_price" {{isset($scenic['ticket'])? 'readOnly': ''}}
                                           value="{{isset($scenic['ticket'])? $scenic['ticket']['floor_price']: ''}}">
                                    <span class="warningTips">*门票底格创建后不能修改</span>
                                    @if ($errors->has('price'))
                                        <span class="warningTips">门票底格不能为空!</span>
                                    @endif
                                </div>
                            </li>
                            <li>
                                <p class="caption01">门票价格：</p>
                                <div>
                                    <input class="t" type="number" id="ticket-price" name="price"
                                           value="{{isset($scenic['ticket'])? $scenic['ticket']['price']: ''}}">
                                    @if ($errors->has('price'))
                                        <span class="warningTips">门票价格不能为空!</span>
                                    @endif
                                </div>
                            </li>
                            <li id="custom-price">
                                <p class="caption01">自定义价格：</p>
                                @if(isset($scenic['ticket']) && count($scenic['ticket']) && count($scenic['ticket']['custom_price']))
                                    @foreach($scenic['ticket']['custom_price'] as $ticket)
                                        <div style="margin-left: 100px;">
                                            <input type="date" class="t" name="start_time[]"
                                                   value="{{date('Y-m-d', $ticket['start_time']-1)}}"
                                                   placeholder="开始时间">---
                                            <input type="date" class="t" name="end_time[]"
                                                   value="{{date('Y-m-d', $ticket['end_time']-1)}}"
                                                   placeholder="结束时间">
                                            <input type="tel" class="t" name="custom_price[]"
                                                   value="{{$ticket['price']}}" placeholder="价格">
                                            <button class="btn del" type="button" onclick="delNode(this)">删除</button>
                                        </div>
                                    @endforeach
                                @else
                                    <div style="margin-left: 100px;">
                                        <input type="date" name="start_time[]" placeholder="开始时间">---
                                        <input type="date" name="end_time[]" placeholder="结束时间">
                                        <input type="tel" name="custom_price[]" placeholder="价格">
                                        <button class="btn del" type="button" onclick="delNode(this)">删除</button>
                                    </div>
                                @endif
                                <button class="btn binding" type="button" onclick="addNode(this)"
                                        style="display: block">添加
                                </button>
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
                                @if ($errors->has('custom_price'))
                                    error
                                @endif
                            </li>
                            <li>
                                <p class="caption01">门票有效时间：</p>
                                <div class="info">
                                    <input class="t" type="tel" pattern="^[0-9]+$" id="ticket-valid-time"
                                           name="valid_time"
                                           value="{{isset($scenic['ticket'])? $scenic['ticket']['valid_time']: ''}}">
                                    @if ($errors->has('valid_time'))
                                        error
                                    @endif
                                </div>
                            </li>
                            <li>
                                <p class="caption01">门票提前时间：</p>
                                <div class="info">
                                    <input class="t" type="tel" pattern="^[0-9]+$" id="ticket-lead-time"
                                           name="lead_time"
                                           value="{{isset($scenic['ticket'])? $scenic['ticket']['lead_time']: ''}}">
                                    @if ($errors->has('valid_time'))
                                        error
                                    @endif
                                </div>
                            </li>
                            <li>
                                <p class="caption01">门票最迟时间：</p>
                                <div class="info">
                                    <input class="t" type="tel" pattern="^[0-9]+$" id="ticket-last-time"
                                           name="last_time"
                                           value="{{isset($scenic['ticket'])? $scenic['ticket']['last_time']: ''}}">
                                    @if ($errors->has('last_time'))
                                        error
                                    @endif
                                </div>
                            </li>
                            <li>
                                <p class="caption01">备注：</p>
                                <div class="info">
                                   <textarea cols="70" rows="6" style="resize: none" id="remark"
                                             name="remark">{{isset($scenic['ticket'])? $scenic['ticket']['remark']: ''}}</textarea>
                                    @if ($errors->has('remark'))
                                        error
                                    @endif
                                </div>
                            </li>
                            <li>
                                <button class="btn btn-warning binding"
                                        type="submit">{{isset($scenic['ticket'])? '修改': '添加'}}</button>
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('user.footer')
@endsection