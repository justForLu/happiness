<?php

namespace App\Repositories\Home;


use App\Enums\BasicEnum;
use App\Repositories\BaseRepository;

class EventRepository extends BaseRepository
{
    public function model()
    {
        return 'App\Models\Common\Event';
    }

    /**
     * 获取案例列表
     * @param array $params
     * @return array
     */
    public function getList($params = [])
    {
        $page = isset($params['page']) && $params['page'] > 0 ? $params['page'] : 1;
        $size = isset($params['size']) && $params['size'] > 0 ? $params['size'] : 10;

        $where = [];

        $count = $this->model->where($where)->count();

        $list = $this->model->where($where)
            ->offset(($page-1)*$size)->limit($size)
            ->orderBy('id','DESC')
            ->get()->toArray();

        $total_page = ceil($count/$size);
        return ['list' => $list,'count' => $count, 'page' => $page, 'total_page' => $total_page];
    }

}
