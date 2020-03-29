<?php

namespace App\Repositories\Home;


use App\Enums\BasicEnum;
use App\Repositories\BaseRepository;

class ProductRepository extends BaseRepository
{
    public function model()
    {
        return 'App\Models\Common\Product';
    }

    /**
     * 获取产品列表
     * @param array $params
     * @return array
     */
    public function getList($params = [])
    {
        $list = $this->model->where('status',BasicEnum::ACTIVE)
            ->orderBy('sort','ASC')
            ->orderBy('id','DESC')
            ->get()->toArray();

        return $list;

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
