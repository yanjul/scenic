@extends('layouts.app')

@section('content')
    <div class="container"  style="min-height: 830px;">
        <div class="row">
            @include('user.menu')
            <div class="col-md-9">
                <div class="breadcrumb">
                    <a href="/user">我的脚印</a>
                    >
                    <span>景区分销</span>
                </div>
            </div>
            <div class="scenic-list distribution distribution-add">
                <div class="media">
                    <label for="scenic"><b>选择景区</b></label>
                    <select id="scenic" onchange="showScenic(this.value)">
                        <option value="0">--选择景区--</option>
                        @foreach($list as $scenic)
                            <option value="{{$scenic->id}}" {{isset($distribution) && $distribution->scenic_id == $scenic->id? 'selected': ''}}>{{$scenic->name}}</option>
                        @endforeach
                    </select>
                    <div id="content">
                        @if(isset($distribution))
                            <div class="media-left">
                                <img src="{{$distribution->scenic->image}}" class="media-object" width="300px"
                                     height="180px">
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">{{$distribution->scenic->name}}</h4>
                                <p class="scenic-content">{{$distribution->scenic->info}}</p>
                            </div>
                            <div class="ticket-desc m-orderList">
                                <table cellspacing="0" cellpadding="0">
                                    <thead>
                                    <tr>
                                        <th>门票名称</th>
                                        <th>票价</th>
                                        <th>数量</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($distribution->scenic->ticket as $ticket)
                                        <tr data-id="{{$ticket->id}}">
                                            <td>{{$ticket->name}}</td>
                                            <td>{{$ticket->price}}</td>
                                            <td>{{$ticket->number}}</td>
                                            <td>
                                                <button class="btn btn-success btn-sm"
                                                        onclick="add(this.parentNode.parentNode)">添加
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                    <div class="ticket-desc m-orderList">
                        <form method="post" action="/user/scenic/create-distribution">
                            <input id="scenic-id" type="hidden" name="scenic_id"
                                   value="{{isset($distribution)? $distribution->scenic_id: 0}}">
                            @if(isset($distribution))
                                <input type="hidden" name="distribution_id" value="{{$distribution->id}}">
                            @endif
                            <label for="name">套餐名称</label>
                            <input id="name" type="text" name="package_name" required
                                   value="{{isset($distribution)? $distribution->package_name: ''}}">
                            <table id="add-ticket" cellspacing="0" cellpadding="0">
                                <thead>
                                <tr>
                                    <th>门票名称</th>
                                    <th>票价</th>
                                    <th>数量</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($distribution))
                                    @foreach($distribution->detail as $detail)
                                        <tr data-id="{{$detail->ticket_id}}">
                                            <td>
                                                <input type="text" name="name[]" value="{{$detail->ticket_name}}">
                                                <input type="hidden" name="ticket_id[]" value="{{$detail->ticket_id}}">
                                            </td>
                                            <td><input type="tel" name="price[]" value="{{$detail->ticket_price}}"></td>
                                            <td><input type="tel" name="number[]" value="{{$detail->ticket_number}}">
                                            </td>
                                            <td>
                                                <buttom class="btn btn-warning btn-sm"
                                                        onclick="del(this.parentNode.parentNode)">删除
                                                </buttom>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                            <button class="btn btn-success" type="submit">{{isset($distribution)? '修改': '创建'}}</button>
                        </form>
                    </div>
                    @section('js')
                        <script>
                            function showScenic(id) {
                                var container = $('#content');
                                container.children().remove();
                                $('#add-ticket').find('tbody').children().remove();
                                if (!parseInt(id)) {
                                    $('#scenic-id').attr('value', 0);
                                    return
                                }
                                $.ajax({
                                    url: '/get-scenic',
                                    type: 'GET',
                                    data: {id: id, ticket: true},
                                    dataType: 'JSON',
                                    success: function (data) {
                                        $('#scenic-id').attr('value', data.id);
                                        var m_l = $(' <div class="media-left"></div>');
                                        m_l.append('<img src="' + data.image + '" class="media-object" width="300px"height="180px">');
                                        var m_b = $(' <div class="media-body"></div>');
                                        m_b.append('<h4 class="media-heading">' + data.name + '</h4>');
                                        m_b.append('<p class="scenic-content">' + data.info + '</p>');
                                        var t = $('<div class="ticket-desc m-orderList"><div>');
                                        t.append(' <table cellspacing="0" cellpadding="0"> <thead> <tr> <th>门票名称</th> <th>票价</th> <th>数量</th> <th>操作</th> </tr> </thead><tbody></tbody></table>');
                                        var t_b = t.find('tbody');
                                        for (var i = 0; i < data.ticket.length; i++) {
                                            t_b.append('<tr data-id="' + data.ticket[i].id + '"><td>' + data.ticket[i].name + '</td><td>' + data.ticket[i].price + '</td><td>' + data.ticket[i].number + '</td><td><button class="btn btn-success btn-sm" onclick="add(this.parentNode.parentNode)">添加</button></td></tr>');
                                        }
                                        container.append(m_l, m_b, t);
                                    },
                                    error: function () {
                                    }
                                });
                            }

                            function add(tr) {
                                var id = $(tr).attr('data-id');
                                var tbody = $('#add-ticket').find('tbody');
                                if (!tbody.find('tr[data-id="' + id + '"]').length) {
                                    tr = tr.cloneNode(true);
                                    var tds = $(tr).find('td');
                                    tds[0].innerHTML = '<input name="name[]" type="text" value="' + tds[0].innerText + '">';
                                    tds[1].innerHTML = '<input name="price[]" type="tel" value="' + tds[1].innerText + '">';
                                    $(tds[1]).append('<input type="hidden" name="ticket_id[]" value="' + id + '">');
                                    tds[2].innerHTML = '<input name="number[]" type="tel" value="1">';
                                    tds[3].innerHTML = '<buttom class="btn btn-warning btn-sm" onclick="del(this.parentNode.parentNode)">删除</buttom>';
                                    tbody.append(tr)
                                }
                            }
                            function del(_this) {
                                $(_this).remove()
                            }
                        </script>
                    @endsection
                    {{--<div class="media-left">--}}
                    {{--<a href="#" class="imgBox">--}}
                    {{--<img src="/images/scenic/wulong1.jpg" alt="" class="media-object" width="300px"--}}
                    {{--height="180px">--}}
                    {{--<p class="imgTitle">武隆</p>--}}
                    {{--</a>--}}
                    {{--</div>--}}
                    {{--<div class="media-body">--}}
                    {{--<h4 class="media-heading"><a href="" class="scenic-title">武隆</a></h4>--}}
                    {{--<p class="scenic-content">--}}
                    {{--武隆，地处重庆市东南边缘，乌江下游，武陵山与大娄山结合部，东西长82.7公...最佳旅游时间：秋季较为适宜游览。因为武隆气候温湿，四季分明，春夏降水量较大。武隆，地处重庆市东南边缘，乌江下游，武陵山与大娄山结合部，东西长82.7公...最佳旅游时间：秋季较为适宜游览。因为武隆气候温湿，四季分明，春夏降水量较大。</p>--}}
                    {{--<div class="des_div">--}}
                    {{--<span class="des_span des_span01">景点类型：自然景观</span>--}}
                    {{--<span class="des_span des_span02">游玩时间：2-4小时</span>--}}
                    {{--<span class="des_span des_span03">适宜季节：四季皆宜</span>--}}
                    {{--</div>--}}
                    {{--</div>--}}

                </div>
            </div>
        </div>
    </div>
    @include('user.footer')
@endsection
