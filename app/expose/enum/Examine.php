<?php

namespace app\expose\enum;

use app\expose\enum\builder\Enum;

class Examine extends Enum
{
    const WAIT = [
        'label' => '待审核',
        'value' => 0,
        'props'=>[
            'type'=>'primary'
        ]
    ];
    const PASS = [
        'label' => '通过',
        'value' => 1,
        'props'=>[
            'type'=>'success'
        ]
    ];
    const REJECT = [
        'label' => '驳回',
        'value' => 2,
        'props'=>[
            'type'=>'danger'
        ]
    ];
}
