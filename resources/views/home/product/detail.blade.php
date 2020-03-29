@extends('home.layout.base')

@section('content')
    <div class="main-newsdate">
        <div class="layui-container">
            <p class="news"><a href="{{url('/home/product.html')}}">产品</a> > 产品详情</p>
            <div>
                <h1>{{$data->title}}</h1>
                <p class="pushtime">发布时间：<span>{{$data->create_time}}</span></p>
            </div>
            <div class="product-detail"><?php echo $data->info ?></div>
        </div>
    </div>
@endsection


