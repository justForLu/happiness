<?php

namespace App\Enums;

/**
 * @method static BaseEnum ENUM()
 */
class BannerEnum extends BaseEnum {

    const BANNER = 1;
    const ROSE = 2;

    static $desc = array(
        'BANNER' => '幻灯片',
        'ROSE' => '玫瑰花',
    );

}
