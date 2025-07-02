<?php

namespace app\model;

use plugin\control\api\Control;
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
        return $value?base64_decode($value):$value;
    }
    public function setNicknameAttr($value)
    {
        return $value?base64_encode($value):$value;
    }
    public function setPasswordAttr($value)
    {
        return $value?Password::encrypt($value):$value;
    }
    public static function getTokenInfo($model)
    {
        $request = request();
        /* 重组用户信息 */
        $User = new \stdClass;
        $User->nickname = $model->nickname;
        $User->headimg = $model->headimg;
        $User->username = $model->username;
        $User->is_system = 1;

        $pluginConfig = glob(base_path("plugin/*/api/{$request->app}/PublicController.php"));
        foreach ($pluginConfig as $path) {
            $plugin_name = basename(dirname(dirname(dirname($path))));
            $class = 'plugin\\' . $plugin_name . "\\api\\{$request->app}\\PublicController";
            if (!class_exists($class)) {
                continue;
            }
            $plugin = new $class;
            if (method_exists($plugin, 'appendUserInfo')) {
                $plugin->appendUserInfo($User, $model);
            }
        }
        /* 生成token */
        $data = new \stdClass;
        $data->uid = $model->id;
        $data->username = $model->username;
        $data->mobile = $model->mobile;
        $data->email = $model->email;
        $User->token = Auth::setPrefix('CONTROL')->encrypt($data);
        return $User;
    }
}
