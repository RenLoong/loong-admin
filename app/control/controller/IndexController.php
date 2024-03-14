<?php

namespace app\control\controller;

use support\Request;

class IndexController
{
    /**
     * 不需要登录的方法
     * @var string[]
     */
    protected $notNeedLogin = ['index'];
    protected $notNeedAuth = ['index'];
    public function index(Request $request)
    {
        $path = $request->path();
        # 如果不是以/结尾的，就重定向到以/结尾的URL
        if (substr($path, -1) != '/') {
            return redirect($path . '/');
        }
        return view(public_path('index.html'));
    }
}
