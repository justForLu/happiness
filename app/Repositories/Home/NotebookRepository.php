<?php

namespace App\Repositories\Home;


use App\Enums\BasicEnum;
use App\Enums\FriendEnum;
use App\Models\Common\Friend;
use App\Repositories\BaseRepository;

class NotebookRepository extends BaseRepository
{
    public function model()
    {
        return 'App\Models\Common\Notebook';
    }

    /**
     * 获取产品列表
     * @param array $params
     * @return array
     */
    public function getList($params = [])
    {
        $page = isset($params['page']) && $params['page'] > 0 ? $params['page'] : 1;
        $size = isset($params['size']) && $params['size'] > 0 ? $params['size'] : 10;
        $user_id = $params['user_id'] ?? 0;
        //暂时逻辑是可以查看自己以及朋友的数据
        $user_ids = Friend::where('oneself',$user_id)
            ->where('status',FriendEnum::AGREE)
            ->pluck('friend');
        $user_ids[] = $user_id;

        $where = [];

        $count = $this->model->where($where)->whereIn('user_id',$user_ids)->count();

        $list = $this->model->where($where)->whereIn('user_id',$user_ids)
            ->offset(($page-1)*$size)->limit($size)
            ->orderBy('id','DESC')
            ->get()->toArray();

        $total_page = ceil($count/$size);
        return ['list' => $list,'count' => $count, 'page' => $page, 'total_page' => $total_page];
    }

    /**
     * 删除小本本
     * @param array $params
     * @return mixed
     */
    public function delNotebook($params = [])
    {
        $id = isset($params['id']) ? $params['id'] : 0;
        $user_id = isset($params['user_id']) ? $params['user_id'] : 0;

        $result = $this->model->where('user_id',$user_id)->where('id',$id)->delete();

        return $result;
    }
}
