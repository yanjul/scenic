@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('user.menu')
            <div class="col-md-9">
                <div class="breadcrumb">
                    <a href="/user">我的脚印</a>
                    >
                    <span>景区分销</span>
                </div>
                <div class="scenic-list distribution">
                    <div class="media">
                        <div class="media-left">
                            <a href="#" class="imgBox">
                                <img src="/images/scenic/wulong1.jpg" alt="" class="media-object" width="300px"
                                     height="180px">
                                <p class="imgTitle">武隆</p>
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading"><a href="" class="scenic-title">武隆</a></h4>
                            <p class="scenic-content">
                                武隆，地处重庆市东南边缘，乌江下游，武陵山与大娄山结合部，东西长82.7公...最佳旅游时间：秋季较为适宜游览。因为武隆气候温湿，四季分明，春夏降水量较大。武隆，地处重庆市东南边缘，乌江下游，武陵山与大娄山结合部，东西长82.7公...最佳旅游时间：秋季较为适宜游览。因为武隆气候温湿，四季分明，春夏降水量较大。</p>
                            <div class="des_div">
                                <span class="des_span des_span01">景点类型：自然景观</span>
                                <span class="des_span des_span02">游玩时间：2-4小时</span>
                                <span class="des_span des_span03">适宜季节：四季皆宜</span>
                            </div>
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
                                <tr>
                                    <td>td</td>
                                    <td>130元</td>
                                    <td>2</td>
                                    <td class="action">
                                        <a class="btn" href="/user/scenic/add-distribution">修改</a>
                                        <a href="#" class="btn">删除</a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
