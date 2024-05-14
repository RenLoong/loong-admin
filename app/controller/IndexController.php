<?php

namespace app\controller;

use app\expose\helper\Config;
use support\Request;

class IndexController
{
    public function index(Request $request)
    {
        $config=new Config('basic');
        return view(public_path('template/index.html'), $config->toArray());
    }
}
