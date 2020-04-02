@extends('admin.layout.base')

@section('content')
    <fieldset class="main-field main-field-title">
        <legend>日程管理</legend>
    </fieldset>
    <div class="main-toolbar">
        @can('event.create')
        <div class="main-toolbar-item"><a href="{{url('admin/event/create')}}" class="btn btn-sm bg-olive" title="创建日程">创建日程</a></div>
        @endcan
    </div>

    <div class="box">
        <div class="box-header">
            <form method="get" action="{{ url('admin/event') }}" class="form-horizontal" role="form">
                <div class="col-sm-2">
                    <input type="text" name="title" placeholder="日程标题" value="{{ isset($params['title']) ?  $params['title'] : ''}}" autocomplete="off" class="form-control">
                </div>
                <div class="col-sm-2">
                    {{\App\Enums\UserEnum::enumSelect(isset($params['username']) ?  $params['username'] : '','请选择添加人','username')}}
                </div>
                <div class="col-sm-2">
                    {{\App\Enums\EventEnum::enumSelect(isset($params['status']) ?  $params['status'] : '','请选择状态','status')}}
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
            <th>日程标题</th>
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
                <td>{{$data->username}}</td>
                <td>{{\App\Enums\EventEnum::getDesc($data->status)}}</td>
                <td>{{$data->create_time}}</td>
                <td>
                    @can('event.edit')
                    <a href="event/{{$data->id}}/edit" class="btn bg-olive btn-xs"><i class="fa fa-pencil"></i>编辑</a>
                    @endcan
                    @can('event.destroy')
                    <a href="{{url('admin/event',array($data->id))}}" class="btn btn-danger btn-xs J_layer_dialog_del" data-token="{{csrf_token()}}"><i class="fa fa-trash-o"></i>删除</a>
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @include('admin.public.pages')
@endsection