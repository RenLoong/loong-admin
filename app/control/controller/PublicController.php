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
        $lang=$request->lang;
        $domain=$request->app;
        $config = Config::get('basic');
        $config = new Web($config);

        $captcha_state = Config::get('captcha', 'state');
        $config->useLogin([
            'url' => 'Login/login',
            'title' => trans('Login Title', [], $domain, $lang),
            'captcha' => $captcha_state,
            'link_text'=>trans('Login Link Text', [], $domain, $lang),
            'user_agreement_config'=>[
                'title'=>trans('Login User Agreement Title', [], $domain, $lang),
                'label'=>trans('Login User Agreement Label', [], $domain, $lang)
            ]
        ]);
        $config->useVcode([
            'url' => 'Login/vcode',
            'title' => trans('Vcode Login', [], $domain, $lang)
        ]);
        $config->useRegister([
            'url' => 'Login/register',
            'title' => trans('Register Title', ['%web_name%'=>$config['web_name']], $domain, $lang),
            'link_text'=>trans('Register Link Text', [], $domain, $lang),
            'user_agreement_config'=>[
                'title'=>trans('Register User Agreement Title', [], $domain, $lang),
                'label'=>trans('Register User Agreement Label', [], $domain, $lang)
            ]
        ]);
        $wechat_official_account = Config::get('wechat_official_account');
        if($wechat_official_account['state']&&$wechat_official_account['message_state']){
            $config->useQrcodeLogin([
                'url' => 'Login/qrcode',
                'check' => 'Login/checkQrcode',
                'title' => trans('Qrcode Login', [], $domain, $lang)
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
            'tips'=>trans('toolbar Lock', [], $domain, $lang)
        ]);
        $toolbar->add(EnumAction::SEARCH['value'], [
            'icon' => 'Search',
            'tips'=>trans('toolbar Search', [], $domain, $lang)
        ]);
        $toolbar->add(EnumAction::NOTIFICATION['value'], [
            'icon' => 'Notification',
            'tips'=>trans('toolbar Notification', [], $domain, $lang)
        ]);
        $toolbar->add(EnumAction::FULL_SCREEN['value'], [
            'icon' => 'FullScreen',
            'tips'=>trans('toolbar FullScreen', [], $domain, $lang)
        ]);
        $config->useToolbar($toolbar->toArray());
        $userDropdownMenu = new Action();
        $userDropdownMenu->add(EnumAction::DIALOG['value'], [
            'path' => 'User/update',
            'label' => trans('userDropdownMenu updateSelf', [], $domain, $lang),
            'icon' => 'User',
            'props' => [
                'type' => 'primary',
                'title' => trans('userDropdownMenu updateSelf', [], $domain, $lang)
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
        return $this->success(trans('Logout Success', [], $request->app, $request->lang));
    }
    public function vcode(Request $request)
    {
        $username = $request->post('username');
        $token = $request->post('token');
        $captcha = $request->post('captcha');
        if (!Captcha::check($captcha, $token)) {
            return $this->fail(trans('Captcha Incorrect', [], $request->app, $request->lang));
        }
        $scene = $request->post('scene');
        if (!$scene) {
            return $this->fail(trans('Scene Cannot Be Empty', [], $request->app, $request->lang));
        }
        try {
            Vcode::send($username, $scene, $token);
            return $this->success(trans('Vcode Send Success', [], $request->app, $request->lang));
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
            return $this->success(trans('Unlock Success', [], $request->app, $request->lang));
        } catch (\Throwable $th) {
            return $this->exception($th);
        }
    }
}
