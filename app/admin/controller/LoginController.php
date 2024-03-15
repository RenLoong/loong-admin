<?php

namespace app\admin\controller;

use app\Basic;
use app\model\Admin;
use app\model\AdminRole;
use app\expose\utils\Password;
use app\expose\enum\ResponseCode;
use app\expose\helper\Captcha;
use app\expose\helper\Config;
use Exception;
use support\Request;

class LoginController extends Basic
{
    /**
     * 不需要登录的方法
     * @var string[]
     */
    protected $notNeedLogin = ['login'];
    protected $notNeedAuth = ['login'];
    public function login(Request $request)
    {
        try {
            $D = $request->post();
            $captcha_state = Config::get('captcha', 'state');
            if ($captcha_state) {
                if (!Captcha::check($D['captcha'], $D['token'])) {
                    throw new Exception("验证码不正确", ResponseCode::CAPTCHA);
                }
            }
            $Admin = Admin::where(['username' => $D['username']])->find();
            if (!$Admin) {
                throw new Exception('密码错误');
            }
            if (!Password::verify($D['password'], $Admin->password)) {
                throw new Exception('密码错误');
            }
            if (!$Admin->state) {
                throw new Exception('管理员账号异常');
            }
            $AdminRole = AdminRole::where(['id' => $Admin->role_id])->find();
            if (!$AdminRole) {
                throw new Exception('管理员角色异常');
            }
            if (!$AdminRole->state) {
                throw new Exception('管理员角色异常');
            }
            if (!$AdminRole->is_system) {
                $now = date('H:i:s');
                if (!($now >= $Admin->allow_time_start && $now <= $Admin->allow_time_end)) {
                    throw new Exception("当前不在工作时间");
                }
                if (!in_array(date('w'), $Admin->allow_week)) {
                    throw new Exception("今日因该是休息日哦");
                }
            }
            $Admin->login_time = date('Y-m-d H:i:s');
            if ($Admin->save()) {
                return $this->success('登录成功', Admin::getTokenInfo($Admin));
            } else {
                throw new Exception("登录失败");
            }
        } catch (\Throwable $th) {
            return $this->exception($th);
        }
    }
}
