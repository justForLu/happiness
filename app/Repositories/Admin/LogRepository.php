<?php

namespace App\Repositories\Admin;


use App\Enums\BasicEnum;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;

class LogRepository extends BaseRepository
{
    public function model()
    {
        return 'App\Models\Admin\Log';
    }

    /**
     * 记录操作日志
     * @param $request
     */
    public function writeOperateLog($request){
        // 记录post请求
        if($request->isMethod('post') || $request->isMethod('put') || $request->isMethod('delete')){
            $action = get_action_name();
            $params = $request->all();
            unset($params['_token']);unset($params['_method']);

            $log = array(
                'user_type' => 1,
                'user_id' => Auth::guard()->user()->id,
                'operate_module' => $action['controller'],
                'operate_action' => $action['method'],
                'operate_params' => json_encode($params,JSON_UNESCAPED_UNICODE),
                'operate_url' => $request->getRequestUri(),
                'ip' => get_client_ip(),
                'gmt_operate' => get_date(),
                'status' => BasicEnum::ACTIVE
            );

            $this->saveModel($log);
        }
    }
}
