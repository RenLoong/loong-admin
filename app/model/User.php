<?php

namespace app\model;

use app\expose\helper\Uploads;
use app\expose\utils\Password;
use loong\oauth\facade\Auth;

class User extends Basic
{
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
    public static function getTokenInfo($model)
    {
        $request = request();
        /* 重组用户信息 */
        $User = new \stdClass;
        $User->nickname = $model->nickname;
        $User->headimg = $model->headimg;
        $User->username = $model->username;

        $pluginConfig = glob(base_path("plugin/*/api/{$request->app}/PublicController.php"));
        foreach ($pluginConfig as $path) {
            $plugin_name = basename(dirname(dirname(dirname($path))));
            $class = 'plugin\\' . $plugin_name . "\\api\\{$request->app}\\PublicController";
            $plugin = new $class;
            $plugin->appendUserInfo($User, $model);
        }
        /* 生成token */
        $data = new \stdClass;
        $data->uid = $model->id;
        $data->username = $model->username;
        $data->mobile = $model->mobile;
        $data->email = $model->email;
        $User->token = Auth::setPrefix('CONTROL')->encrypt($data);
        $User->is_system = 1;
        return $User;
    }
}
