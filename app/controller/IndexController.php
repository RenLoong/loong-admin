<?php

namespace app\controller;

use app\expose\helper\Config;
use support\Request;

class IndexController
{
    public function index(Request $request)
    {
        $config=new Config('basic');
        $templateFile=public_path('template/index.html');
        if (!file_exists($templateFile)) {
            return '请检查 /public/template/index.html 是否存在。';
        }
        return view($templateFile, $config->toArray());
    }
}
