<?php

namespace App\Enums;

/**
 * @method static BaseEnum ENUM()
 */
class UserEnum extends BaseEnum {

    const WL = 1;
    const CJ = 2;

    static $desc = array(
        'WL' => '王',
        'CJ' => '路',
    );

}
