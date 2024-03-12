<?php

namespace app\admin\controller;

use app\Basic;
use app\expose\helper\Captcha;
use support\Request;
use support\Response;

/**
 * 图像验证码
 * Class CaptchaController
 * @package app\api\controller
 */
class CaptchaController extends Basic
{
    /**
     * 不需要登录的方法
     * @var string[]
     */
    protected $notNeedLogin = [
        'captcha', 'captchaCode'
    ];

    /**
     * 获取图像验证码
     * @param Request $request
     * @return Response
     */
    public function captcha(Request $request)
    {
        return Captcha::captcha();
    }

    public function captchaCode()
    {
        return $this->success(null, Captcha::captchaCode());
    }
}
