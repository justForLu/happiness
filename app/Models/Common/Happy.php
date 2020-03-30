<?php

namespace App\Models\Common;

use App\Models\Base;
use Illuminate\Database\Eloquent\SoftDeletes;

class Happy extends Base
{
    use SoftDeletes;
    // 模型对应表名
    protected $table = 'happy';

    protected $fillable = ['title','content','username','image','category'];

}
