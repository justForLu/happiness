<form class="form-horizontal J_ajaxForm" style="margin:10px 20px;" role="form" id="form" action="{{url('admin/remember',array($data->id))}}" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="_method" value="PUT">
    <div class="form-group">
        <label class="col-sm-3 control-label">纪念日标题</label>
        <div class="col-sm-8">
            <input type="text" name="title" autocomplete="off" class="form-control length4" value="{{$data->title}}">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">日期</label>
        <div class="col-sm-8">
            <input type="text" name="day" autocomplete="off" class="form-control length4" value="{{$data->day}}">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">状态</label>
        <div class="col-sm-8">
            {{\App\Enums\UserEnum::enumSelect($data->username,false,'username')}}
        </div>
    </div>
    <div class="form-group hide">
        @can('remember.update')
        <button type="submit" class="J_ajax_submit_btn"></button>
        @endcan
    </div>
</form>