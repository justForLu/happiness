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
                            <label class="col-sm-3 control-label">产品标题</label>
                            <div class="col-sm-8">
                                <input type="text" name="title" value="{{$data->title}}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">产品分类</label>
                            <div class="col-sm-8">
                                <select name="category_id" class="form-control">
                                    @if($category)
                                        @foreach($category as $val)
                                            @if($data->category_id == $val['id'])
                                                <option value="{{$val['id']}}" selected="selected">{{$val['name']}}</option>
                                            @else
                                                <option value="{{$val['id']}}">{{$val['name']}}</option>
                                            @endif
                                            @if($val['children'])
                                                @foreach($val['children'] as $v)
                                                    @if($data->category_id == $val['id'])
                                                        <option value="{{$v['id']}}" selected="selected">{{$v['name']}}</option>
                                                    @else
                                                        <option value="{{$v['id']}}">{{$v['name']}}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">封面图片</label>
                            <div class="col-sm-8">
                                <div class="J_upload_image" data-id="image" data-_token="{{ csrf_token() }}">
                                    @if(!empty($data->image))
                                        <input type="hidden" name="image_val" value="{{ $data->image }}">
                                        <input type="hidden" name="image_path[]" value="{{ $data->image_path[0] }}">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">产品图集</label>
                            <div class="col-sm-8">
                                <div class="J_upload_image" data-id="display" data-width="690" data-_token="{{ csrf_token() }}" data-type="multiple" data-num="5">
                                    @if(!empty($data->display))
                                        @foreach($data->display as $key => $value )
                                            <input type="hidden" name="image_val" value="{{ $key }}">
                                            <input type="hidden" name="image_path[]" value="{{ $value }}">
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">简介</label>
                            <div class="col-sm-8">
                                <textarea name="desc" cols="60" rows="5">{{$data->desc}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">排序</label>
                            <div class="col-sm-8">
                                <input type="text" name="sort" autocomplete="off" class="form-control" value="{{$data->sort}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">状态</label>
                            <div class="col-sm-8">
                                {{\App\Enums\BasicEnum::enumSelect($data->status,false,'status')}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">详情</label>
                            <div class="col-sm-8">
                                <script id="editor" name="info" type="text/plain">
                                    <?php echo $data->info ?>
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

