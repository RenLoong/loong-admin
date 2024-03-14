<?php

namespace app\admin\controller;

use app\Basic;
use app\expose\build\config\Action;
use app\expose\build\config\Web;
use app\expose\enum\Action as EnumAction;
use app\expose\enum\Filesystem;
use app\expose\helper\Config;
use app\expose\helper\Menus;
use loong\oauth\facade\Auth;
use support\Request;

class PublicController extends Basic
{
    /**
     * 不需要登录的方法
     * @var string[]
     */
    protected $notNeedLogin = ['config', 'menus'];
    protected $notNeedAuth = ['config', 'menus'];
    public function config(Request $request)
    {
        $config = Config::get('basic');
        $config = new Web($config);
        $config->useLogin([
            'title' => '管理员登录',
            'url' => 'Login/login',
            'user_agreement' => ''
        ]);
        $config->useApis([
            'userinfo' => 'Admin/getSelfInfo',
            'menus' => 'Public/menus',
            'outLogin' => 'Public/outLogin'
        ]);
        $toolbar = new Action();
        $toolbar->add(EnumAction::LOCK['value'], [
            'icon' => 'Lock'
        ]);
        $toolbar->add(EnumAction::SEARCH['value'], [
            'icon' => 'Search'
        ]);
        $toolbar->add(EnumAction::NOTIFICATION['value'], [
            'icon' => 'Notification'
        ]);
        $toolbar->add(EnumAction::FULL_SCREEN['value'], [
            'icon' => 'FullScreen'
        ]);
        $config->useToolbar($toolbar->toArray());
        $userDropdownMenu = new Action();
        $userDropdownMenu->add(EnumAction::DIALOG['value'], [
            'path' => 'Admin/updateSelf',
            'label' => '管理员信息',
            'icon' => 'User',
            'props' => [
                'type' => 'primary',
                'title' => '管理员信息'
            ]
        ]);
        $config->useUserDropdownMenu($userDropdownMenu->toArray());
        $config->storage = Filesystem::getOptions();
        return $this->resData($config);
    }
    public function menus(Request $request)
    {
        $Install = new \app\admin\api\Install;
        $menus = new Menus($Install);
        return $this->resData($menus);
    }
    public function outLogin(Request $request)
    {
        $token = $request->header('Authorization');
        if ($token) {
            Auth::setPrefix('ADMIN')->delete($token);
        }
        return $this->success('退出成功');
    }
}
