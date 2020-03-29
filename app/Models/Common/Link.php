<?php

namespace App\Models\Common;

use App\Models\Base;

class Link extends Base
{
    // 模型对应表名
    protected $table = 'link';

    protected $fillable = ['title','url','sort','status'];

}
