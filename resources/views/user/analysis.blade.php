@extends('layouts.app')

@section('content')
    <div class="container" style="min-height: 830px;">
        <div class="row">
            @include('user.menu')
            <div class="col-md-9">
                <div class="breadcrumb">
                    <a href="/user">我的脚印</a>
                    >
                    <span>数据分析</span>
                </div>
                <div class="m-box m-orderList">
                    <div style="width: 100%; height:200px;"></div>
                    <div id="main" style="width: 100%; height:400px;"></div>
                </div>
            </div>
        </div>
    </div>
    @include('user.footer')
@endsection
@section('js')
    <script type="text/javascript" src="/js/echarts.min.js"></script>
    <script type="text/javascript">
        var myChart = echarts.init(document.getElementById('main'));
        // 指定图表的配置项和数据
        var option = {
            title: {
                text: '景区销量'
            },
            tooltip: {
                trigger: 'axis'
            },
            legend: {
                data: ['销量']
            },
            toolbox: {
                show: true,
                feature: {
                    magicType: {show: true, type: ['line', 'bar']}
                }
            },
            calculable: true,
            xAxis: {
                type: 'category',
                data: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月']
            },
            yAxis: [{
                type: 'value'
            }],
            series: {
                name: '销量',
                type: 'bar',
                data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                markPoint: {
                    data: [
                        {type: 'max', name: '最大值'},
                        {type: 'min', name: '最小值'}
                    ]
                },
                markLine: {
                    data: [
                        {type: 'average', name: '平均值'}
                    ]
                }
            }
        };
        $.get('/user/get-analysis', {action: 'sale', year: 2017}, function (data) {
            option.xAxis.data.forEach(function (item, index) {
                data.forEach(function (v) {
                    if(parseInt(item) === parseInt(v.month.substr(-2, v.month.length))) {
                        option.series.data[index] = v.number;
                    }
                });
                myChart.setOption(option);
            });

        });
//        myChart.setOption(option);

    </script>
@endsection