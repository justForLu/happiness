<?php

namespace App\Models\Common;

use App\Models\Base;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Base
{
    use SoftDeletes;
    // 模型对应表名
    protected $table = 'user';

    protected $fillable = ['openid','nickname','username','avatarUrl','gender','status'];

}
