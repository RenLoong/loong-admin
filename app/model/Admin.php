<?php

namespace app\model;

use app\expose\helper\Uploads;
use app\expose\utils\Password;
use loong\oauth\facade\Auth;

class Admin extends Basic
{
    protected function getOptions(): array
    {
        return [
            'type' => [
                // 设置JSON字段的类型
                'allow_week'	=>	'json'
            ]
        ];
    }
    public function getHeadimgAttr($value)
    {
        return Uploads::url($value);
    }
    public function setHeadimgAttr($value)
    {
        return Uploads::path($value);
    }
    public function getNicknameAttr($value)
    {
        return base64_decode($value);
    }
    public function setNicknameAttr($value)
    {
        return base64_encode($value);
    }
    public function setPasswordAttr($value)
    {
        return Password::encrypt($value);
    }
    public static function getTokenInfo(Admin $Admin)
    {
        /* 重组用户信息 */
        $AdminUser = new \stdClass;
        $AdminUser->nickname = $Admin->nickname;
        $AdminUser->headimg = $Admin->headimg;
        $AdminUser->username = $Admin->username;
        /* 生成token */
        $data = new \stdClass;
        $data->uid = $Admin->id;
        $data->role_id = $Admin->role_id;
        $data->username = $Admin->username;
        $data->mobile = $Admin->mobile;
        $data->email = $Admin->email;
        $data->allow_time_start = $Admin->allow_time_start;
        $data->allow_time_end = $Admin->allow_time_end;
        $data->allow_week = $Admin->allow_week;
        $AdminRole = AdminRole::where(['id' => $Admin->role_id])->find();
        $data->is_system = $AdminRole->is_system;
        $data->permissions = $AdminRole->rule;
        $AdminUser->role_name = $AdminRole['name'];
        $AdminUser->is_system = $AdminRole->is_system;
        $AdminUser->permissions = $AdminRole->rule;
        $AdminUser->token = Auth::setPrefix('ADMIN')->encrypt($data);
        return $AdminUser;
    }
}
