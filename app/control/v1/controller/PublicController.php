<?php

namespace app\control\v1\controller;

use app\Basic;
use app\expose\build\config\Web;
use support\Request;

class PublicController extends Basic
{
    /**
     * 不需要登录的方法
     * @var string[]
     */
    protected $notNeedLogin = ['config'];
    public function config(Request $request)
    {
        $config = new Web();
        $config->useLogin();
        $config->useVcode([
            'url' => 'Login/vcode',
            'title' => '验证码登录'
        ]);
        $config->useRegister([
            'url' => 'Login/register',
            'title' => '用户注册'
        ]);
        return $this->resData($config);
    }
}
