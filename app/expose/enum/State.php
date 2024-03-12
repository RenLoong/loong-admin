<?php

namespace app\expose\enum;

use app\expose\enum\builder\Enum;

class State extends Enum
{
    const YES = [
        'label' => '正常',
        'value' => 1
    ];
    const NO = [
        'label' => '禁用',
        'value' => 0
    ];
}
