<?php

namespace app\admin\controller;

use app\Basic;
use app\expose\trait\Config;
use support\Request;

class PlatformController extends Basic
{
    use Config;
    public function wechat_miniproject(Request $request)
    {
        return $this->builder();
    }
    public function wechat_official_account(Request $request)
    {
        return $this->builder();
    }
}
