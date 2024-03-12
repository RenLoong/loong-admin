<?php

namespace app\expose\enum;

use app\expose\enum\builder\Enum;

class ResponseEvent extends Enum
{
    /**
     * 通知客户端更新网站配置
     */
    const UPDATE_WEBCONFIG = "UPDATE::WEBCONFIG";
    /**
     * 通知客户端更新用户信息
     */
    const UPDATE_USERINFO = "UPDATE::USERINFO";
}
