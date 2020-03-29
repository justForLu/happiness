<?php

namespace App\Repositories\Admin;


use App\Repositories\BaseRepository;

class ManagerRepository extends BaseRepository
{
    public function model()
    {
        return 'App\Models\Admin\Manager';
    }

    /**
     * 检查用户权限
     * @param $user
     * @param $permission
     * @return bool
     */
    public function hasPermission($user,$permission){
        $roles = $user->roles;

        if($roles){
            foreach($roles as $role){
                $permissions = array_column($role->permissions->toArray(),'id');
                if(in_array($permission->id,$permissions)) return true;
            }
            return false;
        }else{
            return false;
        }
    }

    /**
     * 根据ID获取管理员的姓名
     * @param $ids
     * @return array
     */
    public function getManagerById($ids = 0)
    {
        if(is_array($ids)){
            $list = $this->model->select('id','username')->whereIn('id', $ids)->get()->toArray();
        }else{
            $list = $this->model->select('id','username')->where('id', $ids)->get()->toArray();
        }

        return $list;
    }
}
