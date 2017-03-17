@extends('layouts.app')

@section('content')
    <div class="container main">
        <div class="row">
            @include('user.menu')
            <div class="col-md-9">
                <div class="breadcrumb">
                    <a href="/user">我的脚印 </a>
                    >
                    <span>个人信息</span>
                </div>
                <div class="tab-myfoot">
                    <ul class="title" id="tabfirst">
                        <li class="on">基本资料</li>
                        <li>头像设置</li>
                    </ul>
                    <div class="c-n box01" id="divContentBox">
                        <div class="per-edit-list">
                            <div class="per-edit-msg">完善更多个人信息，有助于我们为您提供更加个性化的服务，脚印将尊重并保护您的隐私。</div>
                            <dl>
                                <dt>昵&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;称：</dt>
                                <dd>
                                    <span class="onSuccess">{{$info['name']}}</span>
                                </dd>
                            </dl>
                            <dl>
                                <dt>真实姓名：</dt>
                                <dd><span class="onSuccess">{{$info['info']['truename'] or '暂未填写'}}</span></dd>
                            </dl>
                            <dl>
                                <dt>手&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;机：</dt>
                                <dd>
                                    @if($info['telephone'])
                                        <span class="onSuccess">{{$info['telephone']}}</span>
                                    @else
                                        <a href="/user/bind-mobile">前去绑定手机</a>
                                    @endif
                                </dd>
                            </dl>
                            <dl>
                                <dt>公司地址：</dt>
                                <dd>
                                    <span class="onSuccess">{{$info['info']['company_address'] or '暂未填写'}}</span>
                                </dd>
                            </dl>
                            <dl>
                                <dt>邮&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;箱：</dt>
                                <dd>
                                    <span class="onSuccess">{{$info['email']}}</span>
                                </dd>
                            </dl>
                            <dl>
                                <dt>传&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;真：</dt>
                                <dd>
                                    <span class="onSuccess">{{$info['info']['fax'] or '暂未填写'}}</span>
                                </dd>
                            </dl>
                            <dl>
                                <dt>备&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;注：</dt>
                                <dd>
                                    <p class="onSuccess">{{$info['info']['remark'] or '暂未填写'}}</p>
                                </dd>
                            </dl>
                            <a id="sumBgn" class="btn05 btn" href="/user/info-update">修改</a>
                        </div>
                        <div class="photoChange">
                            <div class="news_img">
                                <form method="post" action="/user/info/photo" enctype="multipart/form-data">
                                    <label for="" style="display: inline;float: left">选择头像：</label>
                                    <input type="file" name="image" class="file" required onchange="PreviewImage(this,'imgView','pic_preview')"/>
                                    <div style="margin-top: 20px;">
                                        <label class="ncLabel">头像预览：</label>
                                        <img id="imgView" src="{{$info['info']['photo'] ?: '/images/system/default-photo.jpg'}}" alt="" width="240px" height="240px"/>
                                    </div>
                                    <button class="btn btn-sm btn-success">保存</button>
                                </form>
                            </div>

                        </div>
                        <script>
                            function PreviewImage(obj, imgPreviewId, divPreviewId) {
                                var allowExtention = ".jpg,.bmp,.gif,.png"; //,允许上传文件的后缀名
                                var extention = obj.value.substring(obj.value.lastIndexOf(".") + 1).toLowerCase();
                                var browserVersion = window.navigator.userAgent.toUpperCase();
                                if (allowExtention.indexOf(extention) > -1) {
                                    if (browserVersion.indexOf("MSIE") > -1) {
                                        if (browserVersion.indexOf("MSIE 6.0") > -1) {//ie6
                                            document.getElementById(imgPreviewId).setAttribute("src", obj.value);
                                        } else {//ie[7-8]、ie9
                                            obj.select();
                                            var newPreview = document.getElementById(divPreviewId + "New");
                                            if (newPreview == null) {
                                                newPreview = document.createElement("div");
                                                newPreview.setAttribute("id", divPreviewId + "New");
                                                newPreview.style.width = 160;
                                                newPreview.style.height = 170;

                                            }
                                            newPreview.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod='scale',src='" + document.selection.createRange().text + "')";
                                            var tempDivPreview = document.getElementById(divPreviewId);
                                            tempDivPreview.parentNode.insertBefore(newPreview, tempDivPreview);
                                            tempDivPreview.style.display = "none";
                                        }
                                    } else if (browserVersion.indexOf("FIREFOX") > -1) {//firefox
                                        var firefoxVersion = parseFloat(browserVersion.toLowerCase().match(/firefox\/([\d.]+)/)[1]);
                                        if (firefoxVersion < 7) {//firefox7以下版本
                                            document.getElementById(imgPreviewId).setAttribute("src", obj.files[0].getAsDataURL());
                                        } else {//firefox7.0+
                                            document.getElementById(imgPreviewId).setAttribute("src", window.URL.createObjectURL(obj.files[0]));
                                        }
                                    } else if (obj.files) {
                                        //兼容chrome、火狐等，HTML5获取路径
                                        if (typeof FileReader !== "undefined") {
                                            var reader = new FileReader();
                                            reader.onload = function (e) {
                                                document.getElementById(imgPreviewId).setAttribute("src", e.target.result);
                                            }
                                            reader.readAsDataURL(obj.files[0]);
                                        } else if (browserVersion.indexOf("SAFARI") > -1) {
                                            alert("暂时不支持Safari浏览器!");
                                        }
                                    } else {
                                        document.getElementById(divPreviewId).setAttribute("src", obj.value);
                                    }
                                } else {
                                    alert("仅支持" + allowSuffix + "为后缀名的文件!");
                                    obj.value = ""; //清空选中文件
                                    if (browserVersion.indexOf("MSIE") > -1) {
                                        obj.select();
                                        document.selection.clear();
                                    }
                                    obj.outerHTML = obj.outerHTML;
                                }
                            }
                        </script>
                    </div>
                    <script src="jquery-2.1.1.min.js"></script>
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
                </div>
            </div>
        </div>
    </div>
@endsection