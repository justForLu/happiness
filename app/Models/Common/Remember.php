<?php

namespace App\Models\Common;

use App\Models\Base;

class Remember extends Base
{
    // 模型对应表名
    protected $table = 'remember';

    protected $fillable = ['title','day','username'];

}
