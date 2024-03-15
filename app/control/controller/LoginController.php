<?php

namespace app\control\controller;

use app\Basic;
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
    protected $notNeedLogin = ['login', 'qrcode'];
    protected $notNeedAuth = ['login', 'qrcode'];
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
        } catch (Exception $e) {
            return $this->fail($e);
        }
    }
    public function register(Request $request)
    {
        $D = $request->post();
        Captcha::check();
        return $this->success();
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
