<?php

namespace App\Models\Common;

use App\Models\Base;

class Example extends Base
{
    // 模型对应表名
    protected $table = 'example';

    protected $fillable = ['title','image','desc','info','sort','status','display'];

}
