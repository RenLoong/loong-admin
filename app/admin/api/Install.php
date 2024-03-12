<?php

namespace app\admin\api;

use app\expose\api\Install as ApiInstall;

class Install
{
    use ApiInstall;
    public function __construct()
    {
        $this->path = __DIR__;
    }
}
