<?php

namespace app\expose\enum;

use app\expose\enum\builder\Enum;

class WxpayVersion extends Enum
{
    const V3 = [
        'label' => 'V3',
        'value' => 'v3'
    ];
    const V2 = [
        'label' => 'V2',
        'value' => 'v2'
    ];
}
