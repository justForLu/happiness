@extends('admin.layout.base')

@section('content')
    <fieldset class="main-field main-field-title">
        <legend>案例管理</legend>
    </fieldset>
    <div class="main-toolbar">
        @can('example.create')
        <div class="main-toolbar-item"><a href="{{url('admin/example/create')}}" class="btn btn-sm bg-olive" title="创建案例">创建案例</a></div>
        @endcan
    </div>

    <div class="box">
        <div class="box-header">
            <form method="get" action="{{ url('admin/example') }}" class="form-horizontal" role="form">
                <div class="col-sm-2">
                    <input type="text" name="title" placeholder="案例标题" value="{{ isset($params['title']) ?  $params['title'] : ''}}" autocomplete="off" class="form-control">
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
            <th>案例标题</th>
            <th>状态</th>
            <th>排序</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($list as $data)
            <tr>
                <td>{{$data->id}}</td>
                <td>{{$data->title}}</td>
                <td>{{\App\Enums\BasicEnum::getDesc($data->status)}}</td>
                <td>{{$data->sort}}</td>
                <td>
                    @can('example.edit')
                    <a href="example/{{$data->id}}/edit" class="btn bg-olive btn-xs"><i class="fa fa-pencil"></i>编辑</a>
                    @endcan
                    @can('example.destroy')
                    <a href="{{url('admin/example',array($data->id))}}" class="btn btn-danger btn-xs J_layer_dialog_del" data-token="{{csrf_token()}}"><i class="fa fa-trash-o"></i>删除</a>
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @include('admin.public.pages')
@endsection