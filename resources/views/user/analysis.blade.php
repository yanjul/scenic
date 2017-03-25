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
                <div class="tab-myfoot">
                    <ul class="title" id="tabfirst">
                        <li class="on">景区年销量</li>
                        <li>利润分析</li>
                        {{--<li>头像设置2</li>--}}
                    </ul>
                    <div class="c-n box01" id="divContentBox">
                        <div class="photoChange">
                            <div id="sale_volume" style="width: 100%; height:400px;"></div>
                        </div>
                        <div class="photoChange">
                            <span>选择景区</span>
                            <select id="scenic-name"></select>
                            <div id="profit_analysis" style="width: 600px; height:400px;"></div>
                        </div>
                        <div class="photoChange">3333333333333333</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('user.footer')
@endsection
@section('js')
    <script>
        var aLi = document.getElementById("tabfirst").children; //获取Tag下的li，即Tag标签
        var content = document.getElementById("divContentBox").children; //获取Tag标签对应的内容
        content[0].style.display = "block"; //默认显示第一个标签的内容
        var len = aLi.length;
        for (var i = 0; i < len; i++) {
            aLi[i].index = i; //设置对象的INDEX属性，方便下面调用
            aLi[i].onclick = function () {
                for (var n = 0; n < len; n++) {
                    aLi[n].className = "";
                    content[n].style.display = "none";
                }
                aLi[this.index].className = "on";
                content[this.index].style.display = "block";
            }
        }
    </script>
    <script type="text/javascript" src="/js/echarts.min.js"></script>
    <script type="text/javascript">

        //景区年销量分析统计
        var sale_volume_div = echarts.init(document.getElementById('sale_volume'));
        // 指定图表的配置项和数据
        var sale_volume_option = {
            title: {
                text: '景区年销量' + (new Date()).getFullYear()
            },
            tooltip: {
                trigger: 'axis'
            },
            legend: {
                data: ['销量']
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
        $.get('/user/get-analysis', {action: 'sale', year: (new Date()).getFullYear()}, function (data) {
            sale_volume_option.xAxis.data.forEach(function (item, index) {
                data.forEach(function (v) {
                    if (parseInt(item) === parseInt(v.month.substr(-2, v.month.length))) {
                        sale_volume_option.series.data[index] = v.number;
                    }
                });
                sale_volume_div.setOption(sale_volume_option);
            });
        });

        $.get('/get-scenic', {}, function (data) {
            data.forEach(function (item) {
                $('#scenic-name').append($('<option value="' + item.id + '">' + item.name + '</option>'))
            });

        })

        //景区利润分析统计
        var profit_analysis_div = echarts.init(document.getElementById('profit_analysis'));
        profit_analysis_option = {
            title: {
                text: '景区利润',
                x:'center'
            },
            tooltip: {
                trigger: 'axis',
                axisPointer: { // 坐标轴指示器，坐标轴触发有效
                    type: 'shadow' // 默认为直线，可选为：'line' | 'shadow'
                }
            },
            legend: {
                data: ['销售总额', '利润', '成本'],
                align: 'right',
                right: 10
            },
            grid: {
                left: '3%',
                right: '4%',
                bottom: '3%',
                containLabel: true
            },
            xAxis: [{
                type: 'category',
                data: ['景区1', '景区2', '景区3', '景区4', '景区5']
            }],
            yAxis: [{
                type: 'value',
                name: '金额（元）',
                axisLabel: {
                    formatter: '{value}'
                }
            }],
            series: [
                {
                    name: '销售总额',
                    type: 'bar',
                    data: [20, 12, 31, 34,20]
                },
                {
                    name: '利润',
                    type: 'bar',
                    data: [10, 20, 5, 9,12]
                }, {
                    name: '成本',
                    type: 'bar',
                    data: [13, 11, 23, 33,15]
                }
            ]
        };
        profit_analysis_div.setOption(profit_analysis_option);
    </script>
@endsection