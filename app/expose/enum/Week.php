<?php

namespace app\expose\enum;

use app\expose\enum\builder\Enum;

class Week extends Enum
{
    const SUNDAY = [
        'label' => '周日',
        'value' => 0,
        'props' => [
            'type' => 'info'
        ]
    ];
    const MONDAY = [
        'label' => '周一',
        'value' => 1,
        'props' => [
            'type' => 'success'
        ]
    ];
    const TUESDAY = [
        'label' => '周二',
        'value' => 2,
        'props' => [
            'type' => 'success'
        ]
    ];
    const WEDNESDAY = [
        'label' => '周三',
        'value' => 3,
        'props' => [
            'type' => 'success'
        ]
    ];
    const THURSDAY = [
        'label' => '周四',
        'value' => 4,
        'props' => [
            'type' => 'success'
        ]
    ];
    const FRIDAY = [
        'label' => '周五',
        'value' => 5,
        'props' => [
            'type' => 'success'
        ]
    ];
    const SATURDAY = [
        'label' => '周六',
        'value' => 6,
        'props' => [
            'type' => 'info'
        ]
    ];
}
