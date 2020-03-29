<?php

namespace App\Repositories\Admin;

use App\Repositories\BaseRepository;

class CategoryRepository extends BaseRepository
{
    public function model()
    {
        return 'App\Models\Admin\Category';
    }

    /**
     * 获取分类的list
     * @param int $type
     * @return array
     */
    public function getCategoryList($type = 0)
    {
        if($type){
            $list = $this->model->where('type',$type)
                ->where('pid',0)
                ->get();
            if($list){
                foreach ($list as &$v){
                    $child = $this->model->where('type',$type)
                        ->where('pid',$v->id)
                        ->get();
                    $v['children'] = $child;
                }
            }
            return $list;
        }

        return [];
    }

    /**
     * 根据ID获取分类列表
     * @param int $ids
     * @return array
     */
    public function getCategoryById($ids = 0)
    {
        if(is_array($ids)){
            $list = $this->model->select('id','name')->whereIn('id', $ids)->get()->toArray();
        }else{
            $list = $this->model->select('id','name')->where('id', $ids)->get()->toArray();
        }

        return $list;
    }
}
