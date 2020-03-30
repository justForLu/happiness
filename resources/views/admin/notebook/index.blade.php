@extends('admin.layout.base')

@section('content')
    <fieldset class="main-field main-field-title">
        <legend>日记管理</legend>
    </fieldset>
    <div class="main-toolbar">
        @can('notebook.create')
        <div class="main-toolbar-item"><a href="{{url('admin/notebook/create')}}" class="btn btn-sm bg-olive">添加日记</a></div>
        @endcan
    </div>

    <div class="box">
        <div class="box-header">
            <form method="get" action="{{ url('admin/notebook') }}" class="form-horizontal" role="form">
                <div class="col-sm-2">
                    <input type="text" name="title" placeholder="日记标题" value="{{ isset($params['title']) ?  $params['title'] : ''}}" autocomplete="off" class="form-control">
                </div>
                <div class="col-sm-2">
                    {{\App\Enums\UserEnum::enumSelect(isset($params['username']) ?  $params['username'] : '','请选择添加人','username')}}
                </div>
                <div class="col-sm-2">
                    {{\App\Enums\NotebookEnum::enumSelect(isset($params['status']) ?  $params['status'] : '','请选择状态','status')}}
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
            <th>日记标题</th>
            <th>添加人</th>
            <th>状态</th>
            <th>添加时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($list as $data)
            <tr>
                <td>{{$data->id}}</td>
                <td>{{$data->title}}</td>
                <td>{{\App\Enums\UserEnum::getDesc($data->username)}}</td>
                <td>{{\App\Enums\NotebookEnum::getDesc($data->status)}}</td>
                <td>{{$data->create_time}}</td>
                <td>
                    @can('notebook.edit')
                    <a href="notebook/{{$data->id}}/edit" class="btn bg-olive btn-xs"><i class="fa fa-pencil"></i>编辑</a>
                    @endcan
                    @can('notebook.destroy')
                    <a href="{{url('admin/notebook',array($data->id))}}" class="btn btn-danger btn-xs J_layer_dialog_del" data-token="{{csrf_token()}}"><i class="fa fa-trash-o"></i>删除</a>
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @include('admin.public.pages')
@endsection