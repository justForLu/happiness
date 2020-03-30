<?php

namespace App\Enums;

/**
 * @method static BaseEnum ENUM()
 */
class HappyEnum extends BaseEnum {

    const TRAVEL = 1;
    const FOOD = 2;
    const LIFE = 3;

    static $desc = array(
        'TRAVEL' => '旅行',
        'FOOD' => '美食',
        'LIFE' => '生活',
    );

}
