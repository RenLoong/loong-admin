<?php

namespace app\control\controller;

use app\Basic;
use app\expose\build\config\Action;
use app\expose\build\config\Web;
use app\expose\enum\Action as EnumAction;
use app\expose\enum\Filesystem;
use app\expose\helper\Captcha;
use app\expose\helper\Config;
use app\expose\helper\Control;
use app\expose\helper\Vcode;
use loong\oauth\facade\Auth;
use support\Request;

class PublicController extends Basic
{
    /**
     * 不需要登录的方法
     * @var string[]
     */
    protected $notNeedLogin = ['config', 'menus', 'vcode', 'outLogin', 'unlock'];
    protected $notNeedAuth = ['config', 'menus', 'vcode', 'outLogin'];
    public function config(Request $request)
    {
        $config = Config::get('basic');
        $config = new Web($config);

        $captcha_state = Config::get('captcha', 'state');
        $config->useLogin([
            'url' => 'Login/login',
            'captcha' => $captcha_state
        ]);
        $config->useVcode([
            'url' => 'Login/vcode',
            'title' => '验证码登录'
        ]);
        $config->useRegister([
            'url' => 'Login/register',
            'title' => '注册' . $config['web_name']
        ]);
        $wechat_official_account = Config::get('wechat_official_account');
        if($wechat_official_account['state']&&$wechat_official_account['message_state']){
            $config->useQrcodeLogin([
                'url' => 'Login/qrcode',
                'check' => 'Login/checkQrcode',
                'title' => '请使用微信“扫一扫”扫码登录'
            ]);
        }
        $config->useApis([
            'userinfo' => 'User/getInfo',
            'lock' => 'User/lock',
            'unlock' => 'Public/unlock',
            'menus' => 'Public/menus',
            'vcode' => 'Public/vcode',
            'outLogin' => 'Public/outLogin',
        ]);
        $toolbar = new Action();
        $toolbar->add(EnumAction::LOCK['value'], [
            'icon' => 'Lock',
            'tips'=>'锁屏'
        ]);
        $toolbar->add(EnumAction::SEARCH['value'], [
            'icon' => 'Search',
            'tips'=>'搜索菜单'
        ]);
        $toolbar->add(EnumAction::NOTIFICATION['value'], [
            'icon' => 'Notification',
            'tips'=>'查看通知'
        ]);
        $toolbar->add(EnumAction::FULL_SCREEN['value'], [
            'icon' => 'FullScreen',
            'tips'=>'全屏/退出全屏'
        ]);
        $config->useToolbar($toolbar->toArray());
        $userDropdownMenu = new Action();
        $userDropdownMenu->add(EnumAction::DIALOG['value'], [
            'path' => 'User/update',
            'label' => '个人中心',
            'icon' => 'User',
            'props' => [
                'type' => 'primary',
                'title' => '个人中心'
            ]
        ]);
        $config->useUserDropdownMenu($userDropdownMenu->toArray());
        $config->storage = Filesystem::getOptions();
        $pluginConfig = glob(base_path("plugin/*/api/{$request->app}/PublicController.php"));
        foreach ($pluginConfig as $path) {
            $plugin_name = basename(dirname(dirname(dirname($path))));
            $class = 'plugin\\' . $plugin_name . "\\api\\{$request->app}\\PublicController";
            if (!class_exists($class)) {
                continue;
            }
            $plugin = new $class;
            if (method_exists($plugin, 'config')) {
                $plugin->config($config);
            }
        }
        return $this->resData($config);
    }
    public function menus(Request $request)
    {
        $Control = new \app\control\api\Control;
        $menus = new Control($Control);
        return $this->resData($menus);
    }
    public function outLogin(Request $request)
    {
        $token = $request->header('Authorization');
        if ($token) {
            try {
                Auth::setPrefix('CONTROL')->delete($token);
            } catch (\Throwable $th) {
            }
        }
        return $this->success('退出成功');
    }
    public function vcode(Request $request)
    {
        $username = $request->post('username');
        $token = $request->post('token');
        $captcha = $request->post('captcha');
        if (!Captcha::check($captcha, $token)) {
            return $this->fail('验证码不正确');
        }
        $scene = $request->post('scene');
        if (!$scene) {
            return $this->fail('场景不能为空');
        }
        try {
            Vcode::send($username, $scene, $token);
            return $this->success('验证码发送成功');
        } catch (\Throwable $th) {
            return $this->exception($th);
        }
    }
    public function unlock(Request $request)
    {
        $password = $request->post('password');
        try {
            $token = $request->header('Authorization');
            Auth::setPrefix('CONTROL')->unlock($token, $password);
            return $this->success('解锁成功');
        } catch (\Throwable $th) {
            return $this->exception($th);
        }
    }
}
