<?php

namespace app\expose\enum;

use app\expose\enum\builder\Enum;

class Platform extends Enum
{
    const PC = [
        'label' => 'PC',
        'value' => 'pc'
    ];
    const H5 = [
        'label' => 'H5',
        'value' => 'h5'
    ];
    const WECHAT_MINIAPP = [
        'label' => '微信小程序',
        'value' => 'wechat_miniapp'
    ];
    const WECHAT_OFFICIAL_ACCOUNT = [
        'label' => '微信公众号',
        'value' => 'wechat_official_account'
    ];
    const APP = [
        'label' => 'APP',
        'value' => 'app'
    ];
}
