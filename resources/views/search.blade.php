@extends('layouts.app')

@section('css')
    <link href="/css/search.css" rel="stylesheet">
@endsection

@section('content')
    <!--内容-->
    <!--主搜索内容-->
    <div class="search_content">
        <div class="search_guess">
            <p>猜您在找</p>
        </div>
        <div class="search_c">
            <img src="images/xgll.png">
            <div class="search_word">
                <h2>香格里拉</h2>
                <p>"这个离天堂最近的地方天空湛蓝，空气清新。有浓郁的藏族文化气息、辽阔的高山草原牧场。火灾之前的月光古城安逸宁静，普达措风景优美，辽阔的纳帕海适合草原骑行，梅里雪山壮观神圣。"</p>
                <p>门票：<span>免费</span></p>
                <p>景区类型：城市</p>
                <p>最佳季节：5-11月。 五月中下旬至八月，是高原草甸上各种花儿争奇斗艳的时候；金秋则是遍地的血色狼毒花，和层林尽染的缤纷秋色。</p>
                <p>建议游玩：3-7天</p>
            </div>
        </div>
    </div>

    <!--搜索分类-->
    <div class="search_classify">
        <div class="search_classify_box">
            <ul>
                <li>景点类型：</li>
                <li><a href="#">全部</a></li>
                <li><a href="#">城市</a></li>
                <li><a href="#">海岛</a></li>
                <li><a href="#">自然景观</a></li>
            </ul>
        </div>
        <div class="search_classify_box">
            <ul>
                <li>游玩时间：</li>
                <li><a href="#">全部</a></li>
                <li><a href="#">2小时以内</a></li>
                <li><a href="#">2-4小时</a></li>
                <li><a href="#">半天-1天</a></li>
                <li><a href="#">1-4天</a></li>
                <li><a href="#">4天及以上</a></li>
            </ul>
        </div>
        <div class="search_classify_box">
            <ul>
                <li>适宜季节：</li>
                <li><a href="#">春季</a></li>
                <li><a href="#">夏季</a></li>
                <li><a href="#">秋季</a></li>
                <li><a href="#">冬季</a></li>
                <li><a href="#">四季皆宜</a></li>
            </ul>
        </div>
    </div>

    <!--其他搜索-->
    <div class="search_else_box">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab"
                                                      data-toggle="tab">按相关度</a></li>
            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">按热门</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="home">
                <div class="search_else">
                    <div class="search_else_word">
                        <h2>乌镇</h2>
                        <p>"环境很好，而且里面的东西也不贵，西栅比东栅好玩，是很真实的地方，但就是人太多，商业气氛也稍浓，还是东栅比较古朴，很悠闲很清净。"</p>
                        <p>门票：<span>东栅：100.00元 西栅：120.00元 联票（含东栅、西栅）：150.00元</span></p>
                        <p>景区类型：古镇</p>
                        <p>最佳季节：3月-5月季最佳。江南水乡，气候宜人，无寒冬酷暑。</p>
                        <p>建议游玩：1-3天</p>
                    </div>
                    <img src="images/wuzhen.jpg">
                </div>
                <div class="search_else">
                    <div class="search_else_word">
                        <h2>鼓浪屿</h2>
                        <p>"岛上的人民都很悠闲，开了许多浪漫格调的小店。岛上的钢琴博物馆特别美，教堂和别墅都不错。里面的巷子很深，富有古典的气息，有一种浪漫的氛围。海鲜很便宜，最好避开节假日前往。"</p>
                        <p>门票：<span>上岛船票：外地游客35元，从东渡上岛（晚上五点半后可从轮渡上岛）；本地游客凭身份证、暂住证、医保卡等有效证伯仍从轮渡上岛，票价8元。</span></p>
                        <p>景区类型：海边</p>
                        <p>最佳季节：四季适宜 鼓浪屿总体气温比较温和，一年四季花木繁盛。</p>
                        <p>建议游玩：1-2天</p>
                    </div>
                    <img src="images/gulangyu.jpg">
                </div>
                <div class="search_else">
                    <div class="search_else_word">
                        <h2>凤凰</h2>
                        <p>"凤凰是个美丽安逸的小城，风景好，民风也淳朴。这里有古朴的气息，而且有浓郁的古镇文化。清晨和夜晚的凤凰最美，氛围特别好。但是凤凰现在开始收门票，住宿的价格也有些贵。"</p>
                        <p>门票：<span>148.00元</span></p>
                        <p>景区类型：古镇</p>
                        <p>最佳季节：四季皆宜。湘西四季的气候都很适合出行，但七月或九月到湘西旅游还可以赶上苗族农历六月初六的大型歌会或立秋的赶秋节，届时可以感受少数民族的特色节庆。</p>
                        <p>建议游玩：2天</p>
                    </div>
                    <img src="images/fenghuang.jpg">
                </div>
            </div>

            <div role="tabpanel" class="tab-pane fade" id="profile">
                <div class="search_else">
                    <div class="search_else_word">
                        <h2>西湖</h2>
                        <p>"西湖是杭州最著名的景点，推荐租辆自行车骑行。西湖的荷花很漂亮，泛舟湖面也是不错的选择。在这里能够看到绚丽的日落和漂亮的音乐喷泉。不推荐节假日的时候去，人太多。"</p>
                        <p>门票：<span>无</span></p>
                        <p>景区类型：湖泊</p>
                        <p>最佳季节：3-5月、9-11月。3-5月是最适合漫步苏堤踏青赏花；9-11月秋高气爽，满陇桂雨的桂花飘香十里，。不推荐盛夏季节，超过30℃的高温炙烤下，会减少游玩的兴致。</p>
                        <p>建议游玩：3-6小时</p>
                    </div>
                    <img src="images/xihu.jpg">
                </div>
                <div class="search_else">
                    <div class="search_else_word">
                        <h2>黄山</h2>
                        <p>"黄山归来不看岳，仿佛穿梭在人间与仙境。云海与日出很漂亮，天气好的时候光明顶上景色很美。空气很好有种洗肺的感觉，特别震撼。但是景区的门票很贵，山上的食宿也不便宜。"</p>
                        <p>门票：<span>旺季（3月~11月）：230.00元 淡季（12月~2月）：150.00元</span></p>
                        <p>景区类型：山峰</p>
                        <p>最佳季节：四季皆宜。黄山风景绮丽，四季宜游，在黄山欣赏奇松怪石，阴观云海变换，雨觅流泉飞瀑，雪看玉树琼枝，风听空谷松涛。</p>
                        <p>建议游玩：2-3天</p>
                    </div>
                    <img src="images/huangshan.jpg">
                </div>
                <div class="search_else">
                    <div class="search_else_word">
                        <h2>九寨沟</h2>
                        <p>"九寨沟，因沟内有九个藏族寨子而得名。中国最美的水景，美丽的童话世界。在九寨沟内的藏族古寨里体验藏族风情也为一大特色。"</p>
                        <p>门票：<span>旺季（04月01日~11月15日）：220.00元 淡季（11月16日~03月31日）：80.00元</span></p>
                        <p>景区类型：自然保护区</p>
                        <p>最佳季节：9月-10月最佳。 深秋11月是九寨沟最为灿烂的时期，清空湛碧，红叶、彩林倒映在明丽的湖水中绚丽多彩。但这一时期是旺季，恰遇国庆假日，游人很多，建议避开放假。 </p>
                        <p>建议游玩：1-3天</p>
                    </div>
                    <img src="images/jiuzhaigou.jpg">
                </div>
            </div>
        </div>
    </div>

    <!--底部-->
    <div class="index_footer">
        &copy;2017&nbsp;FootPrint&nbsp;脚印
    </div>
@endsection