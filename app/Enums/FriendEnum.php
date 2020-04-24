<?php

namespace App\Enums;

/**
* @method static BaseEnum ENUM()
*/
class FriendEnum extends BaseEnum {

    const APPLY = 1;
    const AGREE = 2;
    const REFUSE = 3;
    const DELETE = 4;

    static $desc = array(
        'APPLY' => '申请',
        'AGREE' => '同意',
        'REFUSE' => '拒绝',
        'DELETE' => '删除',
    );
}
