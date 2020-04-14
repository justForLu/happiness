@extends('admin.layout.base')

@section('content')
    <fieldset class="main-field main-field-title">
        <legend>编辑分类</legend>
    </fieldset>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <form class="form-horizontal J_ajaxForm" style="margin:10px 20px;" role="form" id="form" action="{{url('admin/happy',array($data->id))}}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">生活点滴标题</label>
                            <div class="col-sm-8">
                                <input type="text" name="title" value="{{$data->title}}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">添加人</label>
                            <div class="col-sm-8">
                                {{\App\Enums\UserEnum::enumSelect($data->username,false,'username')}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">分类</label>
                            <div class="col-sm-8">
                                {{\App\Enums\HappyEnum::enumSelect($data->category,false,'category')}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">详情</label>
                            <div class="col-sm-8">
                                <script id="editor" name="content" type="text/plain">
                                    <?php echo $data->content ?>
                                </script>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="col-xs-2 col-md-1 col-sm-offset-3">
                                @can('happy.update')
                                    <button type="submit" class="btn btn-primary J_ajax_submit_btn">提交</button>
                                @endcan
                            </div>
                            <div class="col-xs-2 col-md-1">
                                <a href="{{url('admin/happy')}}" class="btn btn-default">取消</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{asset('/assets/plugins/ueditor/ueditor.config.js')}}"></script>
    <script src="{{asset('/assets/plugins/ueditor/ueditor.all.js')}}"></script>
    <script type="text/javascript">
        var ue = UE.getEditor('editor');
    </script>
@endsection


