<?php

namespace App\Models\Common;

use App\Models\Base;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notebook extends Base
{
    use SoftDeletes;
    // 模型对应表名
    protected $table = 'notebook';

    protected $fillable = ['title','content','username','status'];

}
