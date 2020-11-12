<?php
namespace App\Http\Controllers\Home;

use App\Repositories\Home\UserRepository as User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends BaseController
{

    protected $user;

    public function __construct(User $user)
    {
        parent::__construct();

        $this->user = $user;
    }


    /**
     * 登陆
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $params = $request->all();
        if(!isset($params['code']) || empty($params['code'])){
            return $this->ajaxError('缺少参数code');
        }

        $info = $this->user->login($params);
        if(is_numeric($info) && $info == -1){
            return $this->ajaxError('code已过期或其他原因');
        }

        return $this->ajaxSuccess($info,'OK');
    }

    /**
     * 更新用户信息
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function user(Request $request)
    {
        $params = $request->all();

        $res = $this->user->updateUser($params);
        if($res == -1){
            return $this->ajaxError('用户信息有误');
        }

        return $this->ajaxSuccess();
    }

    /**
     * 获取统计数据
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function userCount(Request $request)
    {

        $params = $request->all();

        $result = $this->user->userCount($params);

        return $this->ajaxSuccess($result,'OK');
    }

}
