@extends('admin.layout.base')

@section('content')
    <fieldset class="main-field main-field-title">
        <legend>纪念日管理</legend>
    </fieldset>
    <div class="main-toolbar">
        @can('remember.create')
        <div class="main-toolbar-item"><a href="{{url('admin/remember/create')}}" class="btn btn-sm bg-olive J_layer_dialog" title="添加纪念日">添加纪念日</a></div>
        @endcan
    </div>

    <div class="box">
        <div class="box-header">
            <form method="get" action="{{ url('admin/remember') }}" class="form-horizontal" role="form">
                <div class="col-sm-2">
                    <input type="text" name="title" placeholder="纪念日标题" value="{{ isset($params['title']) ?  $params['title'] : ''}}" autocomplete="off" class="form-control">
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
            <th>纪念日标题</th>
            <th>日期</th>
            <th>添加人</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($list as $data)
            <tr>
                <td>{{$data->id}}</td>
                <td>{{$data->title}}</td>
                <td>{{$data->day}}</td>
                <td>{{\App\Enums\UserEnum::getDesc($data->username)}}</td>
                <td>
                    @can('remember.edit')
                    <a href="remember/{{$data->id}}/edit" class="btn bg-olive btn-xs J_layer_dialog"><i class="fa fa-pencil"></i>编辑</a>
                    @endcan
                    @can('remember.destroy')
                    <a href="{{url('admin/remember',array($data->id))}}" class="btn btn-danger btn-xs J_layer_dialog_del" data-token="{{csrf_token()}}"><i class="fa fa-trash-o"></i>删除</a>
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @include('admin.public.pages')
@endsection