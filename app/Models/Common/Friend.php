<?php

namespace App\Models\Common;

use App\Models\Base;

class Friend extends Base
{
    // 模型对应表名
    protected $table = 'friend';

    protected $fillable = ['oneself','friend','status'];

}
