<?php

namespace App\Repositories\Admin\Criteria;

use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface as Repository;

class HappyCriteria extends Criteria {

    private $conditions;

    public function __construct($conditions){
        $this->conditions = $conditions;
    }

    /**
     * @param $model
     * @param Repository $repository
     * @return mixed
     */
    public function apply($model, Repository $repository)
    {

        if(isset($this->conditions['title']) && !empty($this->conditions['title'])){
            $model = $model->where('title', 'like','%' . $this->conditions['title'] . '%');
        }
        if(isset($this->conditions['category']) && !empty($this->conditions['category'])){
            $model = $model->where('category',$this->conditions['category']);
        }
        if(isset($this->conditions['username']) && !empty($this->conditions['username'])){
            $model = $model->where('username',$this->conditions['username']);
        }

        $model = $model->orderBy('id','DESC');

        return $model;
    }
}