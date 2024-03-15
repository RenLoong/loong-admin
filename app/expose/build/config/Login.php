<?php

namespace app\expose\build\config;

use app\expose\utils\DataModel;

class Login extends DataModel
{
    protected $data = [
        # 是否启用登录
        'enable'            => true,
        # 登录标题
        'title'             => '账号密码登录',
        # 登录请求地址
        'url'               => 'Login/login',
        # 检测登录状态地址
        'check'             => 'Login/check',
        # 登录页背景，auto：自动，off：关闭，url：自定义，url[]：多张图片
        'bg_image'          => 'auto',
        # 登录页展示图片
        'image'             => '',
        # 开启图形验证码，在短信登录时默认开启
        'captcha'           => true,
        # 用户协议链接
        'user_agreement'    => '/article/content/user_agreement.html',
    ];
    public function __construct(array $data = [])
    {
        $this->data = array_merge($this->data, $data);
    }
}
