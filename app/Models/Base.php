<?php
/**
 * Created by PhpStorm.
 * User: Yolanda
 * Date: 2017/10/12
 * Time: 10:12
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Base extends Model{
    const CREATED_AT='create_time';
    const UPDATED_AT='update_time';
    const DELETED_AT='delete_time';

    /**
     * 软删除
     */
    protected $softDelete = false;

    /**
     * 自动维护时间戳
     */
    public $timestamps = true;

    /**
     * 时间戳格式
     */
    public $dateFormat = 'U';
}