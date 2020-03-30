@extends('admin.layout.base')

@section('content')
    <fieldset class="main-field main-field-title">
        <legend>生活点滴</legend>
    </fieldset>
    <div class="main-toolbar">
        @can('happy.create')
        <div class="main-toolbar-item"><a href="{{url('admin/happy/create')}}" class="btn btn-sm bg-olive">添加生活点滴</a></div>
        @endcan
    </div>

    <div class="box">
        <div class="box-header">
            <form method="get" action="{{ url('admin/happy') }}" class="form-horizontal" role="form">
                <div class="col-sm-2">
                    <input type="text" name="title" placeholder="生活点滴标题" value="{{ isset($params['title']) ?  $params['title'] : ''}}" autocomplete="off" class="form-control">
                </div>
                <div class="col-sm-2">
                    {{\App\Enums\UserEnum::enumSelect(isset($params['username']) ?  $params['username'] : '','请选择添加人','username')}}
                </div>
                <div class="col-sm-2">
                    {{\App\Enums\HappyEnum::enumSelect(isset($params['category']) ?  $params['category'] : '','请选择分类','category')}}
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
            <th>生活点滴标题</th>
            <th>分类</th>
            <th>添加人</th>
            <th>添加时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($list as $data)
            <tr>
                <td>{{$data->id}}</td>
                <td>{{$data->title}}</td>
                <td>{{\App\Enums\HappyEnum::getDesc($data->category)}}</td>
                <td>{{\App\Enums\UserEnum::getDesc($data->username)}}</td>
                <td>{{$data->create_time}}</td>
                <td>
                    @can('happy.edit')
                    <a href="happy/{{$data->id}}/edit" class="btn bg-olive btn-xs"><i class="fa fa-pencil"></i>编辑</a>
                    @endcan
                    @can('happy.destroy')
                    <a href="{{url('admin/happy',array($data->id))}}" class="btn btn-danger btn-xs J_layer_dialog_del" data-token="{{csrf_token()}}"><i class="fa fa-trash-o"></i>删除</a>
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @include('admin.public.pages')
@endsection