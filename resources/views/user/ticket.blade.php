@extends('layouts.app')

@section('content')
    <h3>门票</h3>
    <div class="container">
        <div>
            <h4>景区名字</h4>
            <img src="{{$scenic['image']}}" height="200">
        </div>
        @foreach($scenic['ticket'] as $ticket)
            <div style="border: 2px solid #f0ad4e; display: inline-block; vertical-align: top; width: 240px; height: 240px">
                <p>名称{{$ticket['name']}}</p>
                <p>价格{{$ticket['price']}}</p>
                <p>
                    自定义价格
                    @foreach($ticket['custom_price'] as $item)
                        <ul style="list-style: none">
                            <li style="display: inline-block">开始时间{{date('Y-m-d H:i:s', $item['start_time'])}}</li>
                            <li style="display: inline-block">结束时间{{date('Y-m-d H:i:s', $item['end_time'])}}</li>
                            <li style="display: inline-block">价格{{$item['price']}}</li>
                        </ul>
                    @endforeach
                    </p>
                    <p>有效时间{{$ticket['valid_time']}}天</p>
                    <p>提前时间{{$ticket['lead_time']}}天</p>
                    <p>最迟入园时间{{$ticket['last_time']}}点</p>
                    <p>备注{{$ticket['remark']}}点</p>
                    <p>
                        <a href="{{url('user/scenic/ticket/'.$ticket['id'])}}">修改</a>
                        <a href="{{url('user/del-ticket/'.$ticket['id'])}}">删除</a>
                    </p>
            </div>
        @endforeach
    </div>
@endsection