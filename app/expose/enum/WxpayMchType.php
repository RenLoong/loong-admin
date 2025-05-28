<?php

namespace app\expose\enum;

use app\expose\enum\builder\Enum;

class WxpayMchType extends Enum
{
    const NORMAL = [
        'label' => '普通商户',
        'value' => 'normal'
    ];
    const SERVICE = [
        'label' => '子商户 (服务商模式)',
        'value' => 'service'
    ];
}
