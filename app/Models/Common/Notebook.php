<?php

namespace App\Models\Common;

use App\Models\Base;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notebook extends Base
{
    use SoftDeletes;
    // 模型对应表名
    protected $table = 'notebook';

    protected $fillable = ['user_id','title','content','username','status'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
