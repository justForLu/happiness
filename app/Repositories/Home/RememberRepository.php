<?php

namespace App\Repositories\Home;


use App\Enums\FriendEnum;
use App\Models\Common\Friend;
use App\Repositories\BaseRepository;

class RememberRepository extends BaseRepository
{
    public function model()
    {
        return 'App\Models\Common\Remember';
    }


    public function getList($params = [])
    {
        $user_id = $params['user_id'] ?? 0;
        //暂时逻辑是可以查看自己以及朋友的数据
        $user_ids = Friend::where('oneself',$user_id)
            ->where('status',FriendEnum::AGREE)
            ->pluck('friend');
        $user_ids[] = $user_id;

        $list = $this->model->where('user_id',$user_ids)
            ->orderBy('day','ASC')
            ->orderBy('id','DESC')
            ->get()->toArray();

        return $list;
    }

    /**
     * 删除小本本
     * @param array $params
     * @return mixed
     */
    public function delRemember($params = [])
    {
        $id = isset($params['id']) ? $params['id'] : 0;
        $user_id = isset($params['user_id']) ? $params['user_id'] : 0;

        $result = $this->model->where('user_id',$user_id)->where('id',$id)->delete();

        return $result;
    }

}
