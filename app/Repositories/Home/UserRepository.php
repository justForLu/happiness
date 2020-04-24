<?php

namespace App\Repositories\Home;


use App\Enums\BasicEnum;
use App\Models\Common\Event;
use App\Models\Common\Happy;
use App\Models\Common\Notebook;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Log;

class UserRepository extends BaseRepository
{
    public function model()
    {
        return 'App\Models\Common\User';
    }

    /**
     * 用户登录
     * @param array $params
     * @return mixed
     */
    public function login($params = [])
    {
        $code = isset($params['code']) ? $params['code'] : '';
        $wxInfo = $this->code2Session($code);
        $wxInfo = json_decode($wxInfo, true);

        $openid = isset($wxInfo['openid']) ? $wxInfo['openid'] : '';
        if(!$openid){
            return -1;  //未获取到openID
        }

        //判断是否存在openID，存在则返回用户信息；不存在则插入用户信息之后返回用户信息
        $info = $this->model->select('id','openid')->where('openid',$openid)
            ->first();
        if(!$info){
            $ins_data = [
                'openid' => $openid,
                'create_time' => time()
            ];

            $id = $this->model->insertGetId($ins_data);

            $info = [
                'id' => $id,
                'openid' => $openid
            ];
        }

        return $info;
    }

    public function getUser()
    {

    }

    /**
     * 更新用户信息
     * @param array $params
     */
    public function updateUser($params = [])
    {
        $id = isset($params['id']) ? $params['id'] : '';
        if($id){
            $data = [
                'nickName' => isset($params['nickName']) ? $params['nickName'] : '',
                'avatarUrl' => isset($params['avatarUrl']) ? $params['avatarUrl'] : '',
                'gender' => isset($params['gender']) ? $params['gender'] : 1,
                'status' => BasicEnum::ACTIVE,
                'update_time' => time()
            ];

            $this->model->where('id',$id)->update($data);
        }
    }

    /**
     * 获取用户的统计数据
     * @param array $params
     * @return array
     */
    public function userCount($params = [])
    {
        $user_id = isset($params['user_id']) ? $params['user_id'] : 0;

        if($user_id){
            $event = Event::where('user_id',$user_id)->count();
            $notebook = Notebook::where('user_id',$user_id)->count();
            $happy = Happy::where('user_id',$user_id)->count();
        }

        $result['event'] = isset($event) ? $event : 0;
        $result['notebook'] = isset($notebook) ? $notebook : 0;
        $result['happy'] = isset($happy) ? $happy : 0;

        return $result;
    }

    /**
     * 根据code获取openID
     * @param $code
     * @return bool|string
     */
    public function code2Session($code)
    {
        $url = 'https://api.weixin.qq.com/sns/jscode2session?appid=' . env('APPID') . '&secret=' . env('APPSECRET') . '&js_code=' . $code . '&grant_type=authorization_code';
        //$result = $this->getData($url, 'code2Session');
        $result = fn_get_contents($url);
        if (empty($result)) {
            throw new Exception('获取session_key及openID时异常，微信内部错误');
        }
        return $result;
    }
}
