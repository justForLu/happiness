<?php

namespace App\Enums;

/**
 * @method static BaseEnum ENUM()
 */
class NotebookEnum extends BaseEnum {

    const BORN = 1;
    const DONE = 2;

    static $desc = array(
        'BORN' => '想法诞生',
        'DONE' => '计划完成',
    );

}
