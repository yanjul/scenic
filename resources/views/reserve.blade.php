@extends('layouts.app')

@section('css')
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/pay.css" rel="stylesheet">
    <link href="/css/flatpickr.min.css" rel="stylesheet">
@endsection
@section('content')
    <!--商品详情内容-->
    <div class="detail_content">
        <form action="/order/create-reserve" method="post">
            <table class="table table1 table-condensed table-bordered">
                <tr>
                    <td>景区名字</td>
                    <td>{{$data['info']['scenic_name']}}
                        <input type="hidden" name="scenic_id" value="{{$data['info']['scenic_id']}}">
                    </td>
                </tr>
                <tr>
                    <td>门票信息</td>
                    <td style="border-top: 0" colspan="2">
                        <table class="table table-bordered" style="width: 100%">
                            <tr>
                                <td style="color: darkcyan">门票名字</td>
                                <td style="color: darkcyan">门票价格</td>
                                <td style="color: darkcyan">门票数量</td>
                                <td style="color: darkcyan">门票有效时间</td>
                            </tr>
                            @foreach($data['detail'] as $detail)
                                <tr>
                                    <td style="color: orange;">{{$detail['ticket_name']}}
                                        <input type="hidden" name="ticket_id[]" value="{{$detail['ticket_id']}}">
                                    </td>
                                    <td style="color: orange;">{{$detail['ticket_price']}}元</td>
                                    <td style="color: orange;">{{$detail['ticket_numbers']}}
                                        <input type="hidden" name="ticket_number[]" value="{{$detail['ticket_numbers']}}">
                                    </td>
                                    <td style="color: orange;">{{$detail['valid_time']}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>游客姓名</td>
                    <td>{{$data['info']['tourist_name']}}</td>
                </tr>
                <tr>
                    <td>手机号</td>
                    <td>{{$data['info']['mobile']}}</td>
                </tr>
                <tr>
                    <td>价格</td>
                    <td>{{$data['info']['pay_price']}}</td>
                </tr>
                <tr>
                    <td><label>入园时间</label></td>
                    <td>
                        <input id="flatpickr-tryme" placeholder="请选择日期" name="admission_time" value="{{ old('admission_time') }}">
                        @if($errors->has('admission_time'))
                            <div style="color: brown">请您选择正确的入园时间</div>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>备注</td>
                    <td>
                        <textarea name="remark">{{ old('remark') }}</textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">

                        <button type='submit' class="btn btn-success pull-right" data-toggle="modal" id="zhifu"
                                data-target="#myModal">预定
                        </button>

                    </td>
                </tr>
            </table>
        </form>
    </div>
    <!--底部-->
    @include('user.footer')
@endsection

@section('js')
    <script src="/js/flatpickr.min.js"></script>
    <script>
        document.getElementById("flatpickr-tryme").flatpickr();
    </script>
@endsection