<?php

namespace App\Repositories\Home;


use App\Repositories\BaseRepository;

class RememberRepository extends BaseRepository
{
    public function model()
    {
        return 'App\Models\Common\Remember';
    }


    public function getList()
    {
        $list = $this->model->orderBy('day','ASC')
            ->orderBy('id','DESC')
            ->get()->toArray();

        return $list;
    }


}
