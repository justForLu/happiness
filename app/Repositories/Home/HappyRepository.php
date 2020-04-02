<?php

namespace App\Repositories\Home;


use App\Enums\BasicEnum;
use App\Repositories\BaseRepository;

class HappyRepository extends BaseRepository
{
    public function model()
    {
        return 'App\Models\Common\Happy';
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

        $where = [];

        $count = $this->model->where($where)->count();

        $list = $this->model->where($where)
            ->offset(($page-1)*$size)->limit($size)
            ->orderBy('id','DESC')
            ->get()->toArray();

        $total_page = ceil($count/$size);
        return ['list' => $list,'count' => $count, 'page' => $page, 'total_page' => $total_page];

    }

    /**
     * 根据ID获取产品信息
     * @param int $id
     * @return mixed
     */
    public function getById($id = 0)
    {
        $result = $this->model->where('id',$id)->first();

        return $result;
    }

}
