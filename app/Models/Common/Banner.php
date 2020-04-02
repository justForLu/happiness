<?php

namespace App\Models\Common;

use App\Models\Base;

class Banner extends Base
{
    // 模型对应表名
    protected $table = 'banner';

    protected $fillable = ['title','image','category','status','sort'];

}
