<?php

namespace app\control\controller;

use app\Basic;
use app\expose\enum\EventName;
use app\expose\utils\Password;
use app\expose\enum\ResponseCode;
use app\expose\enum\State;
use app\expose\helper\Captcha;
use app\expose\helper\Config;
use app\expose\helper\User as HelperUser;
use app\expose\helper\Vcode;
use app\expose\helper\Wechat;
use app\expose\utils\wechat\OfficialAccount;
use app\model\User;
use Exception;
use GuzzleHttp\Client;
use support\Redis;
use support\Request;
use Webman\Event\Event;

class LoginController extends Basic
{
    /**
     * 不需要登录的方法
     * @var string[]
     */
    protected $notNeedLogin = ['login', 'vcode', 'qrcode', 'register','checkQrcode'];
    protected $notNeedAuth = ['login', 'vcode', 'qrcode', 'register','checkQrcode'];
    public function login(Request $request)
    {
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
        if (!$User->password) {
            throw new Exception('当前用户不支持密码登录，请使用验证码登录');
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
        $User->login_ip = $request->getRealIp(true);
        $User->login_time = date('Y-m-d H:i:s');
        if ($User->save()) {
            Event::emit(EventName::USER_LOGIN['value'], $User);
            return $this->success('登录成功', User::getTokenInfo($User));
        } else {
            throw new Exception("登录失败");
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
            try {
                HelperUser::register([
                    'mobile' => $username
                ]);
                $User = User::where(['mobile' => $username])->find();
            } catch (\Throwable $th) {
                return $this->exception($th);
            }
        }
        if ($User->state != State::YES['value']) {
            return $this->fail('用户已被禁用');
        }
        if (!$User->activation_time) {
            $User->activation_time = date('Y-m-d H:i:s');
        }
        $User->login_ip = $request->getRealIp(true);
        $User->login_time = date('Y-m-d H:i:s');
        if ($User->save()) {
            Event::emit(EventName::USER_LOGIN['value'], $User);
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
        if (!Vcode::check($username, $vcode, 'register', $token)) {
            return $this->fail('验证码不正确');
        }
        $password = $request->post('password');
        try {
            HelperUser::register([
                'mobile' => $username,
                'password' => $password
            ]);
            return $this->success('注册成功');
        } catch (\Throwable $th) {
            return $this->exception($th);
        }
    }
    public function qrcode(Request $request)
    {
        try {
            $OfficialAccount=new OfficialAccount;
            $expire=5*60;
            $params=[];
            if($request->icode){
                $params['puid'] = HelperUser::getUidByIcode($request->icode);
            }
            $id=$OfficialAccount->createSCANScene($expire,[\app\control\event\WechatOfficialAccount::class,'login',$params]);
            $data=[
                'expire_seconds'=>$expire,
                'action_name'=>'QR_STR_SCENE',
                'action_info'=>[
                    'scene'=>[
                        'scene_str'=>$id
                    ]
                ]
            ];
            $res=Wechat::createQrCode($data);
        } catch (\Throwable $th) {
            return $this->exception($th);
        }
        $data = [
            'id' => $id,
            'qrcode' => $res['url'],
            'expire' => $expire
        ];
        return $this->resData($data);
    }
    public function checkQrcode(Request $request)
    {
        $id=$request->post('id');
        $uid=Redis::get($id.'_callback');
        if($uid){
            $User=User::where('id',$uid)->find();
            if($User){
                return $this->success('登录成功', User::getTokenInfo($User));
            }else{
                return $this->fail('登录失败');
            }
        }
        return $this->code(ResponseCode::WAIT);
    }
}
