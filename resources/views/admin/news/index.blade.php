@extends('admin.layout.base')

@section('content')
    <fieldset class="main-field main-field-title">
        <legend>新闻管理</legend>
    </fieldset>
    <div class="main-toolbar">
        @can('news.create')
        <div class="main-toolbar-item"><a href="{{url('admin/news/create')}}" class="btn btn-sm bg-olive">添加新闻</a></div>
        @endcan
    </div>

    <div class="box">
        <div class="box-header">
            <form method="get" action="{{ url('admin/news') }}" class="form-horizontal" role="form">
                <div class="col-sm-2">
                    <input type="text" name="title" placeholder="新闻标题" value="{{ isset($params['title']) ?  $params['title'] : ''}}" autocomplete="off" class="form-control">
                </div>
                <div class="col-sm-2">
                    <select name="category_id" class="form-control">
                        <option value="0">请选择新闻分类</option>
                        @if($category)
                            @foreach($category as $val)
                                @if(isset($params['category_id']) && $params['category_id'] == $val['id'])
                                    <option value="{{$val['id']}}" selected="selected">{{$val['name']}}</option>
                                @else
                                    <option value="{{$val['id']}}">{{$val['name']}}</option>
                                @endif
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-sm-2">
                    {{\App\Enums\BasicEnum::enumSelect(isset($params['status']) ?  $params['status'] : '','请选择状态','status')}}
                </div>
                <div class="col-sm-1">
                    <button type="submit" class="btn bg-olive">搜索</button>
                </div>
            </form>
        </div>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>新闻标题</th>
            <th>分类</th>
            <th>排序</th>
            <th>状态</th>
            <th>阅读量</th>
            <th>作者</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($list as $data)
            <tr>
                <td>{{$data->id}}</td>
                <td>{{$data->title}}</td>
                <td>{{$data->category_name}}</td>
                <td>{{$data->sort}}</td>
                <td>{{\App\Enums\BasicEnum::getDesc($data->status)}}</td>
                <td>{{$data->read}}</td>
                <td>{{$data->admin_name}}</td>
                <td>
                    @can('news.edit')
                    <a href="news/{{$data->id}}/edit" class="btn bg-olive btn-xs"><i class="fa fa-pencil"></i>编辑</a>
                    @endcan
                    @can('news.destroy')
                    <a href="{{url('admin/news',array($data->id))}}" class="btn btn-danger btn-xs J_layer_dialog_del" data-token="{{csrf_token()}}"><i class="fa fa-trash-o"></i>删除</a>
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @include('admin.public.pages')
@endsection