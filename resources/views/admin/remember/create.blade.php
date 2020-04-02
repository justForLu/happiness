<form class="form-horizontal J_ajaxForm" style="margin:10px 20px;" role="form" id="form" action="{{url('admin/remember')}}" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <label class="col-sm-3 control-label">纪念日标题</label>
        <div class="col-sm-8">
            <input type="text" name="title" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">日期</label>
        <div class="col-sm-8">
            <input type="text" name="day" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">添加人</label>
        <div class="col-sm-8">
            {{\App\Enums\UserEnum::enumSelect(\App\Enums\UserEnum::WL,false,'username')}}
        </div>
    </div>
    <div class="form-group hide">
        @can('remember.store')
        <button type="submit" class="J_ajax_submit_btn"></button>
        @endcan
    </div>
</form>

