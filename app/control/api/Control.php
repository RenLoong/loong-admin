<?php

namespace app\control\api;

use app\expose\api\Control as ApiControl;

class Control
{
    use ApiControl;
    public function __construct()
    {
        $this->path = __DIR__;
    }
}
