<?php

namespace app\expose\enum;

use app\expose\enum\builder\Enum;

class SmsChannels extends Enum
{
    const ALIYUN = [
        'label' => '阿里云短信',
        'value' => 'aliyun'
    ];
    const TENCENT = [
        'label' => '腾讯云短信',
        'value' => 'tencent'
    ];
}
