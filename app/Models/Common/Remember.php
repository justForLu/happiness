<?php

namespace App\Models\Common;

use App\Models\Base;
use Illuminate\Database\Eloquent\SoftDeletes;

class Remember extends Base
{
    use SoftDeletes;
    // 模型对应表名
    protected $table = 'remember';

    protected $fillable = ['user_id','title','day','username'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
