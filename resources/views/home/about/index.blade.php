@extends('home.layout.base')

@section('content')
    <div class="banner about">
        <div class="title">
            <p>关于我们</p>
            <p class="en">About Us</p>
        </div>
    </div>
    <div class="main-about">
        <div class="layui-container">
            <div class="layui-row">
                <ul class="aboutab">
                    <li class="layui-this">公司简介</li><li>意见反馈</li>
                </ul>
                <div class="tabIntro">
                    <div class="content">
                        <div class="layui-inline img"><img src="{{asset('/assets/home/image/us_img1.jpg')}}"></div><div class="layui-inline panel">
                            <p></p>
                        </div>
                    </div>
                    <div class="content">
                        <div class="layui-inline panel p_block">
                            <p></p>
                        </div><div class="layui-inline img"><img src="{{asset('/assets/home/image/us_img2.jpg')}}"></div>
                    </div>
                    <div class="content">
                        <div class="layui-inline img"><img src="{{asset('/assets/home/image/us_img3.jpg')}}"></div><div class="layui-inline panel">
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="tabCour">
                    <div id="container" class="map"></div>
                    <div class="feedback">
                        <div class="layui-form-item">
                            <div class="layui-input-block">
                                <input type="text" name="name" id="name" lay-verify="required" lay-reqtext="请输入姓名" placeholder="请输入姓名" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-input-block">
                                <input type="text" name="mobile" id="mobile" lay-reqtext="请输入姓名" placeholder="请输入手机号" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-input-block">
                                <input type="text" name="email" id="email" lay-reqtext="请输入姓名" placeholder="请输入邮箱" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-input-block">
                                <textarea name="content" id="content" placeholder="请输入意见内容" class="layui-textarea"></textarea>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-input-block">
                                <button class="layui-btn" id="feedbackSub">提交</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset("/assets/plugins/jquery-2.2.3.min.js")}}"></script>
    <script src="{{asset("/assets/plugins/layer/layer.js")}}"></script>
    <script type="text/javascript" src="https://webapi.amap.com/maps?v=1.4.15&key=a9ef099582b8abffad85df7a65246f36"></script>
    <script type="text/javascript">
        var map = new AMap.Map('container', {
            zoom:16,//级别
            center: [113.728965,34.772684],//中心点坐标
            viewMode:'3D'//使用3D视图
        });
        var marker = new AMap.Marker({
            icon: "https://webapi.amap.com/theme/v1.3/markers/n/mark_b.png",
            position: [113.728965,34.772684]
        });
        map.add(marker);
    </script>
    <script type="text/javascript">
        $('#feedbackSub').on('click',function () {
            var name = $('#name').val();
            var mobile = $('#mobile').val();
            var email = $('#email').val();
            var content = $('#content').val();
            //提交前的验证
            if(!name){
                layer.msg('请留下尊姓大名');
                return false;
            }
            if(!mobile && !email){
                layer.msg('请留一个联系方式');
                return false;
            }
            if(!content){
                layer.msg('请输入意见内容');
                return false;
            }
            $.post("{{url('/home/feedback')}}",{name:name,mobile:mobile,email:email,content:content},function (obj) {
                if(obj.code == 200){
                    layer.msg(obj.msg);
                }else{
                    layer.msg('提交失败');
                }
            });
        });
    </script>
@endsection
