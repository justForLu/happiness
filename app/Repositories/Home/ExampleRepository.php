<?php

namespace App\Repositories\Home;


use App\Enums\BasicEnum;
use App\Repositories\BaseRepository;

class ExampleRepository extends BaseRepository
{
    public function model()
    {
        return 'App\Models\Common\Example';
    }

    /**
     * 获取案例列表
     * @param array $params
     * @return array
     */
    public function getList($params = [])
    {
        $page = isset($params['page']) && $params['page'] > 0 ? $params['page'] : 1;
        $size = isset($params['size']) && $params['size'] > 0 ? $params['size'] : 9;

        $where[] = ['status','=',BasicEnum::ACTIVE];

        $count = $this->model->where($where)->count();

        $list = $this->model->where($where)
            ->offset($page-1)->limit($size)
            ->orderBy('sort','ASC')
            ->orderBy('id','DESC')
            ->get()->toArray();

        return ['list' => $list,'count' => $count];
    }

}
