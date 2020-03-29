<?php

namespace App\Models\Admin;

use App\Models\Base;

class Log extends Base
{
    // 模型对应表名
    protected $table = 'log';

    public $timestamps = false;

    /**
     * 日志操作人
     */
    public function manager(){
        return $this->hasOne(Manager::class,'id','user_id');
    }
}
