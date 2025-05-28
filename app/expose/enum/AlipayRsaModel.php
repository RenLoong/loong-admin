<?php

namespace app\expose\enum;

use app\expose\enum\builder\Enum;

class AlipayRsaModel extends Enum
{
    const PUBLIC_CERT = [
        'label' => '公钥证书',
        'value' => 'public_cert',
    ];
    const PUBLIC_KEY = [
        'label' => '公钥',
        'value' => 'public_key',
    ];
}
