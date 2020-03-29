@extends('home.layout.base')

@section('content')
    <div class="banner case">
        <div class="title">
            <p>成功案例</p>
            <p class="en">Successful Case</p>
        </div>
    </div>
    <div class="main-case">
        <div class="layui-container">
            <div class="layui-row">
                @if($list)
                    @foreach($list as $k => $v)
                        @if($k%3 == 2)
                            <div class="layui-inline content even center">
                                <div class="layui-inline case-img"><img src="{{$v['image_path']}}"></div>
                                <p class="lable">{{$v['title']}}</p>
                                <p>{{$v['desc']}}</p>
                            </div>
                        @else
                            <div class="layui-inline content">
                                <div class="layui-inline case-img"><img src="{{$v['image_path']}}"></div>
                                <p class="lable">{{$v['title']}}</p>
                                <p>{{$v['desc']}}</p>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
            <div id="casePage"></div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        layui.use('laypage', function(){
            var laypage = layui.laypage;
            //动态分页
            laypage.render({
                elem: 'newsPage'
                ,count: '{{$count}}'
                ,theme: '#2db5a3'
                ,layout: ['page', 'next']
                ,jump: function(obj, first){
                    //obj包含了当前分页的所有参数，比如：
                    console.log(obj.curr); //得到当前页，以便向服务端请求对应页的数据。
                    console.log(obj.limit); //得到每页显示的条数

                    //首次不执行
                    if(!first){
                        //do something
                    }
                }
            });
        });
    </script>
@endsection
