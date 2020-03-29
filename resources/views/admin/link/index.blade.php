@extends('admin.layout.base')

@section('content')
    <fieldset class="main-field main-field-title">
        <legend>友情链接管理</legend>
    </fieldset>
    <div class="main-toolbar">
        @can('link.create')
        <div class="main-toolbar-item"><a href="{{url('admin/link/create')}}" class="btn btn-sm bg-olive J_layer_dialog" title="创建友情链接">创建友情链接</a></div>
        @endcan
    </div>

    <div class="box">
        <div class="box-header">
            <form method="get" action="{{ url('admin/link') }}" class="form-horizontal" role="form">
                <div class="col-sm-2">
                    <input type="text" name="title" placeholder="友情链接标题" value="{{ isset($params['title']) ?  $params['title'] : ''}}" autocomplete="off" class="form-control">
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
            <th>友情链接标题</th>
            <th>友情链接</th>
            <th>排序</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($list as $data)
            <tr>
                <td>{{$data->id}}</td>
                <td>{{$data->title}}</td>
                <td>{{$data->url}}</td>
                <td>{{$data->sort}}</td>
                <td>{{\App\Enums\BasicEnum::getDesc($data->status)}}</td>
                <td>
                    @can('link.edit')
                    <a href="link/{{$data->id}}/edit" class="btn bg-olive btn-xs J_layer_dialog"><i class="fa fa-pencil"></i>编辑</a>
                    @endcan
                    @can('link.destroy')
                    <a href="{{url('admin/link',array($data->id))}}" class="btn btn-danger btn-xs J_layer_dialog_del" data-token="{{csrf_token()}}"><i class="fa fa-trash-o"></i>删除</a>
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @include('admin.public.pages')
@endsection