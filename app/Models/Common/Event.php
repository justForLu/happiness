<?php

namespace App\Models\Common;

use App\Models\Base;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Base
{
    use SoftDeletes;
    // 模型对应表名
    protected $table = 'event';

    protected $fillable = ['title','content','username','status'];

}
