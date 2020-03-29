@extends('home.layout.base')

@section('content')
    <div class="banner product">
        <div class="title">
            <p>产品展示{{$module}}</p>
            <p class="en">Product Display</p>
        </div>
    </div>
    <div class="main product">
        <div class="layui-container">
            @if($list)
                @foreach($list as $val)
                    <div class="content layui-row">
                        <div class="layui-col-xs12 layui-col-sm6 layui-col-md7 layui-col-lg6 content-img">
                            <img src="{{asset('/assets/home/image/Product_img1.jpg')}}">
                        </div>
                        <div class="layui-col-xs12 layui-col-sm6 layui-col-md5 layui-col-lg6 right">
                            <p class="label">{{$val['title']}}</p>
                            <p class="detail">{{$val['desc']}}</p>
                            <div><a href="{{url('/home/product/'.$val['id'].'.html')}}">查看产品 ></a></div>
                        </div>
                    </div>
                @endforeach
            @else
                <div>暂无数据</div>
            @endif
        </div>
    </div>
@endsection
