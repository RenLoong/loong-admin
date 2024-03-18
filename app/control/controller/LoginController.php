<?php

namespace app\control\controller;

use app\Basic;
use app\expose\utils\Password;
use app\expose\enum\ResponseCode;
use app\expose\enum\State;
use app\expose\helper\Captcha;
use app\expose\helper\Config;
use app\expose\helper\User as HelperUser;
use app\expose\helper\Vcode;
use app\model\User;
use Exception;
use support\Request;

class LoginController extends Basic
{
    /**
     * 不需要登录的方法
     * @var string[]
     */
    protected $notNeedLogin = ['login', 'vcode', 'qrcode'];
    protected $notNeedAuth = ['login', 'vcode', 'qrcode'];
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
            $where = [];
            $where[] = ['mobile|username', '=', $D['username']];
            $User = User::where($where)->find();
            if (!$User) {
                throw new Exception('用户不存在');
            }
            if (!Password::verify($D['password'], $User->password)) {
                throw new Exception('密码错误');
            }
            if (!$User->state) {
                throw new Exception('用户已被禁用');
            }
            if (!$User->activation_time) {
                $User->activation_time = date('Y-m-d H:i:s');
            }
            $User->login_ip = $request->getRemoteIp(true);
            $User->login_time = date('Y-m-d H:i:s');
            if ($User->save()) {
                return $this->success('登录成功', User::getTokenInfo($User));
            } else {
                throw new Exception("登录失败");
            }
        } catch (Exception $e) {
            return $this->fail($e);
        }
    }
    public function vcode(Request $request)
    {
        $vcode = $request->post('vcode');
        $username = $request->post('username');
        $token = $request->post('token');
        if (!Vcode::check($username, $vcode, 'login', $token)) {
            return $this->fail('验证码不正确');
        }
        $User = User::where(['mobile' => $username])->find();
        if (empty($User)) {
            return $this->fail('用户不存在');
        }
        if ($User->state != State::YES['value']) {
            return $this->fail('用户已被禁用');
        }
        if (!$User->activation_time) {
            $User->activation_time = date('Y-m-d H:i:s');
        }
        $User->login_ip = $request->getRemoteIp(true);
        $User->login_time = date('Y-m-d H:i:s');
        if ($User->save()) {
            return $this->success('登录成功', User::getTokenInfo($User));
        } else {
            throw new Exception("登录失败");
        }
    }
    public function register(Request $request)
    {
        $vcode = $request->post('vcode');
        $username = $request->post('username');
        $token = $request->post('token');
        if (!Vcode::check($username, $vcode, 'login', $token)) {
            return $this->fail('验证码不正确');
        }
        $password = $request->post('password');
        try {
            HelperUser::register([
                'username' => $username,
                'password' => $password
            ]);
            return $this->success('注册成功');
        } catch (\Throwable $th) {
            return $this->exception($th);
        }
    }
    public function qrcode(Request $request)
    {
        $data = [
            'id' => $request->sessionId(),
            'qrcode' => 'https://www.baidu.com/img/PCtm_d9c8750bed0b3c7d089fa7d55720d6cf.png?t=' . time(),
            'expire' => 180
        ];
        return $this->resData($data);
    }
    public function check(Request $request)
    {
        sleep(2);
        return $this->fail();
    }
}
