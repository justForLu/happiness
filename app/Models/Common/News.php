<?php

namespace App\Models\Common;

use App\Models\Base;

class News extends Base
{
    // 模型对应表名
    protected $table = 'news';

    protected $fillable = ['title','category_id','desc','image','info','sort','status','read','admin_id'];

}
