@extends('home.layout.base')

@section('content')
    <div>
        <div class="layui-carousel" id="banner">
            <div carousel-item>
                <div>
                    <img src="{{asset('/assets/home/image/banner1.jpg')}}">
                    <div class="panel">
                        <p class="title">拾叁网络</p>
                        <p>定制化网站开发</p>
                    </div>
                </div>
                <div>
                    <img src="{{asset('/assets/home/image/banner2.jpg')}}">
                    <div class="panel">
                        <p class="title">拾叁网络</p>
                        <p>一对一技术服务</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-product">
        <div class="layui-container">
            <p class="title">专为中小企业而研制的<span>核心产品</span></p>
            <div class="layui-row layui-col-space25">
                <div class="layui-col-sm6 layui-col-md3">
                    <div class="content">
                        <div><img src="{{asset('/assets/home/image/Big_icon1.png')}}"></div>
                        <div>
                            <p class="label">小程序</p>
                            <p>从小屏逐步扩展到大屏，最终实现所有屏幕适配，适应移动互联潮流。</p>
                        </div>
                        <a href="javascript:;">查看产品 ></a>
                    </div>
                </div>
                <div class="layui-col-sm6 layui-col-md3 ">
                    <div class="content">
                        <div><img src="{{asset('/assets/home/image/Big_icon2.png')}}"></div>
                        <div>
                            <p class="label">定制官网</p>
                            <p>从小屏逐步扩展到大屏，最终实现所有屏幕适配，适应移动互联潮流。</p>
                        </div>
                        <a href="javascript:;">查看产品 ></a>
                    </div>
                </div>
                <div class="layui-col-sm6 layui-col-md3 ">
                    <div class="content">
                        <div><img src="{{asset('/assets/home/image/Big_icon3.png')}}"></div>
                        <div>
                            <p class="label">商城网站</p>
                            <p>从小屏逐步扩展到大屏，最终实现所有屏幕适配，适应移动互联潮流。</p>
                        </div>
                        <a href="javascript:;">查看产品 ></a>
                    </div>
                </div>
                <div class="layui-col-sm6 layui-col-md3 ">
                    <div class="content">
                        <div><img src="{{asset('/assets/home/image/Big_icon4.png')}}"></div>
                        <div>
                            <p class="label">技术服务</p>
                            <p>从小屏逐步扩展到大屏，最终实现所有屏幕适配，适应移动互联潮流。</p>
                        </div>
                        <a href="javascript:;">查看产品 ></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-service">
        <div class="layui-container">
            <p class="title">为客户打造完美的<span>专业服务</span></p>
            <div class="layui-row layui-col-space25 layui-col-space80">
                <div class="layui-col-sm6">
                    <div class="content">
                        <div class="content-left"><img src="{{asset('/assets/home/image/home_img1.jpg')}}"></div>
                        <div class="content-right">
                            <p class="label">一对一需求对接</p>
                            <span></span>
                            <p>更有多个包含不同主题的Web组件，可快速构建界面出色、体验优秀的跨屏页面，大幅提升开发效率。</p>
                        </div>
                    </div>
                </div>
                <div class="layui-col-sm6">
                    <div class="content">
                        <div class="content-left"><img src="{{asset('/assets/home/image/home_img2.jpg')}}"></div>
                        <div class="content-right">
                            <p class="label">定制化需求开发</p>
                            <span></span>
                            <p>更有多个包含不同主题的Web组件，可快速构建界面出色、体验优秀的跨屏页面，大幅提升开发效率。</p>
                        </div>
                    </div>
                </div>
{{--                <div class="layui-col-sm6">--}}
{{--                    <div class="content">--}}
{{--                        <div class="content-left"><img src="{{asset('/assets/home/image/home_img3.jpg')}}"></div>--}}
{{--                        <div class="content-right">--}}
{{--                            <p class="label">1 对 1 前端指导</p>--}}
{{--                            <span></span>--}}
{{--                            <p>更有多个包含不同主题的Web组件，可快速构建界面出色、体验优秀的跨屏页面，大幅提升开发效率。</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="layui-col-sm6">--}}
{{--                    <div class="content">--}}
{{--                        <div class="content-left"><img src="{{asset('/assets/home/image/home_img4.jpg')}}"></div>--}}
{{--                        <div class="content-right">--}}
{{--                            <p class="label">1 对 1 前端指导</p>--}}
{{--                            <span></span>--}}
{{--                            <p>更有多个包含不同主题的Web组件，可快速构建界面出色、体验优秀的跨屏页面，大幅提升开发效率。</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
            <div class="service-more"><a href="">查看更多</a></div>
        </div>
    </div>
@endsection
