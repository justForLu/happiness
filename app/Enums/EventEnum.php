<?php

namespace App\Enums;

/**
 * @method static BaseEnum ENUM()
 */
class EventEnum extends BaseEnum {

    const BORN = 1;
    const PLAN = 2;
    const DONE = 3;
    const CANCEL = 4;

    static $desc = array(
        'BORN' => '想法诞生',
        'PLAN' => '计划中',
        'DONE' => '计划完成',
        'CANCEL' => '计划取消',
    );

}
