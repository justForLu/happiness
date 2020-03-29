@extends('home.layout.base')

@section('content')
    <div class="banner news">
        <div class="title">
            <p>实时新闻</p>
            <p class="en">Real-time News</p>
        </div>
    </div>
    <!-- main -->
    <div class="main-news">
        <div class="layui-container">
            <div class="layui-row layui-col-space20">
                @if($list)
                    @foreach($list as $v)
                        <div class="layui-col-lg6 content">
                            <div>
                                <div class="news-img"><a href="{{url('/home/news/'.$v['id'].'.html')}}"><img src="{{$v['image_path']}}"></a></div><div class="news-panel">
                                    <strong><a href="{{url('/home/news/'.$v['id'].'.html')}}">{{$v['title']}}</a></strong>
                                    <p class="detail"><span>{{$v['desc']}}</span><a href="{{url('/home/news/'.$v['id'].'.html')}}">[详细]</a></p>
                                    <p class="read-push">阅读 <span>{{$v['read']}}</span>&nbsp;&nbsp;&nbsp;&nbsp;发布时间：<span>{{$v['create_time']}}</span></p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div id="newsPage"></div>
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
