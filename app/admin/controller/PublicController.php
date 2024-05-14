<?php

namespace app\admin\controller;

use app\Basic;
use app\expose\build\config\Action;
use app\expose\build\config\Web;
use app\expose\enum\Action as EnumAction;
use app\expose\enum\Filesystem;
use app\expose\enum\ResponseEvent;
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
    protected $notNeedLogin = ['config', 'menus', 'unlock'];
    protected $notNeedAuth = ['config', 'menus', 'unlock'];
    public function config(Request $request)
    {
        $config = Config::get('basic');
        $config = new Web($config);
        $captcha_state = Config::get('captcha', 'state');
        $config->useLogin([
            'title' => '管理员登录',
            'url' => 'Login/login',
            'user_agreement' => '',
            'captcha' => $captcha_state
        ]);
        $config->useApis([
            'userinfo' => 'Admin/getSelfInfo',
            'lock' => 'Public/lock',
            'unlock' => 'Public/unlock',
            'menus' => 'Public/menus',
            'outLogin' => 'Public/outLogin'
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
        $toolbar->add(EnumAction::LINK['value'], [
            'icon' => 'House',
            'tips'=>'网站首页',
            'props'=>[
                'url'=>'/',
                'target'=>'_blank'
            ]
        ]);
        $toolbar->add(EnumAction::LINK['value'], [
            'icon' => 'ElementPlus',
            'tips'=>'网站前台控制台',
            'props'=>[
                'url'=>'/control/',
                'target'=>'_blank'
            ]
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
            try {
                Auth::setPrefix('ADMIN')->delete($token);
            } catch (\Throwable $th) {
            }
        }
        return $this->success('退出成功');
    }
    public function lock(Request $request)
    {
        try {
            $password = $request->post('password');
            if (!$password) {
                return $this->fail('PIN码不能为空');
            }
            if (mb_strlen($password) != 6) {
                return $this->fail('请输入6位PIN码');
            }
            $token = $request->header('Authorization');
            Auth::setPrefix('CONTROL')->lock($token, $password);
            return $this->event(ResponseEvent::UPDATE_USERINFO, '锁定成功');
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
