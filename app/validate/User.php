<?php

namespace app\validate;

use app\expose\validate\Validate;

class User extends Validate
{
    protected $rule =   [
        'username' => 'length:4,30|alphaDash|unique:user',
        'nickname' => 'require|length:2,30',
        'password' => 'length:5,30',
        'mobile' => 'mobile',
        'email' => 'email'
    ];

    protected $message  =   [
        'username.require' => '用户名不能为空',
        'username.length' => '用户名长度为4-30位',
        'username.alphaDash' => '用户名只能包含字母、数字、下划线和破折号',
        'username.unique' => '用户名已存在',
        'nickname.require' => '昵称不能为空',
        'nickname.length' => '昵称长度为2-30位',
        'password.length' => '密码长度为5-30位',
        'mobile' => '手机号格式错误',
        'email' => '邮箱格式错误'
    ];
    protected $scene = [
        'self'  =>  ['username', 'nickname', 'password', 'mobile', 'email']
    ];
}
