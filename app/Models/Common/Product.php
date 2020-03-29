<?php

namespace App\Models\Common;

use App\Models\Base;

class Product extends Base
{
    // 模型对应表名
    protected $table = 'product';

    protected $fillable = ['title','category_id','image','display','desc','info','sort','status'];

}
