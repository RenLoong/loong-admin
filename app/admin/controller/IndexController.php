<?php

namespace app\admin\controller;

use support\Request;

class IndexController
{
    /**
     * 不需要登录的方法
     * @var string[]
     */
    protected $notNeedLogin = ['index'];
    public function index(Request $request)
    {
        return view(public_path('admin/index.html'));
    }
}
