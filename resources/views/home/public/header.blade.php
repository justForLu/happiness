<div class="nav">
    <div class="layui-container">
        <!-- 公司logo -->
        <div class="nav-logo">
            <a href="/">
                <img src="{{asset('/assets/home/image/logo.png')}}" alt="拾叁网络">
            </a>
        </div>
        <div class="nav-list">
            <button>
                <span></span><span></span><span></span>
            </button>
            <ul class="layui-nav" lay-filter="">
                @if($module == 'index')
                    <li class="layui-nav-item layui-this"><a href="{{url('/home/index.html')}}">首页</a></li>
                @else
                    <li class="layui-nav-item"><a href="{{url('/home/index.html')}}">首页</a></li>
                @endif
                @if($module == 'product')
                    <li class="layui-nav-item layui-this"><a href="{{url('/home/product.html')}}">产品</a></li>
                @else
                    <li class="layui-nav-item"><a href="{{url('/home/product.html')}}">产品</a></li>
                @endif
                @if($module == 'news')
                    <li class="layui-nav-item layui-this"><a href="{{url('/home/news.html')}}">动态</a></li>
                @else
                    <li class="layui-nav-item"><a href="{{url('/home/news.html')}}">动态</a></li>
                @endif
                @if($module == 'example')
                    <li class="layui-nav-item layui-this"><a href="{{url('/home/example.html')}}">案例</a></li>
                @else
                    <li class="layui-nav-item"><a href="{{url('/home/example.html')}}">案例</a></li>
                @endif
                @if($module == 'about')
                    <li class="layui-nav-item layui-this"><a href="{{url('/home/about.html')}}">关于</a></li>
                @else
                        <li class="layui-nav-item"><a href="{{url('/home/about.html')}}">关于</a></li>
                @endif
            </ul>
        </div>
    </div>
</div>