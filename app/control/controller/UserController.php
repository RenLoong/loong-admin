<?php

namespace app\control\controller;

use app\Basic;
use app\expose\build\builder\FormBuilder;
use app\expose\enum\ResponseEvent;
use app\model\User;
use app\validate\User as ValidateUser;
use loong\oauth\facade\Auth;
use support\Request;

class UserController extends Basic
{
    public function update(Request $request)
    {
        $id = $request->uid;
        if ($request->method() === 'POST') {
            $D = $request->post();
            $D['id'] = $id;
            try {
                $validate = new ValidateUser;
                $validate->scene('self')->check($D);
            } catch (\Throwable $th) {
                return $this->exception($th);
            }
            $User = User::where(['id' => $D['id']])->find();
            if (!$User) {
                return $this->fail('用户不存在');
            }
            if (!$User->username) {
                $User->username = $D['username'];
            }
            $User->nickname = $D['nickname'];
            $User->headimg = $D['headimg'];
            $User->mobile = $D['mobile'];
            $User->email = $D['email'];
            if ($D['password']) {
                $User->password = $D['password'];
            }
            if ($User->save()) {
                return $this->event(ResponseEvent::UPDATE_USERINFO, '保存成功');
            }
            return $this->fail('保存失败');
        }
        $User = User::where(['id' => $id])->withoutField('password')->find();
        if (!$User) {
            return $this->fail('用户不存在');
        }
        $builder = new FormBuilder();
        $builder->add('username', '账号', 'input', '', [
            'props' => [
                'maxlength' => 30,
                'show-word-limit' => true,
                'disabled' => $User->username ? true : false
            ]
        ]);
        $builder->add('password', '密码', 'input', '', [
            'props' => [
                'placeholder' => '不修改密码请留空',
                'maxlength' => 30,
                'show-word-limit' => true
            ]
        ]);
        $builder->add('nickname', '昵称', 'input', '', [
            'required' => true,
            'maxlength' => 30,
            'show-word-limit' => true
        ]);
        $builder->add('headimg', '头像', 'bundle', '', [
            'props' => [
                'accept' => 'image/*',
                'multiple' => 1
            ]
        ]);
        $builder->add('mobile', '手机号', 'input', '', [
            'props' => [
                'maxlength' => 11,
                'show-word-limit' => true
            ]
        ]);
        $builder->add('email', '邮箱', 'input', '', [
            'props' => [
                'maxlength' => 50,
                'show-word-limit' => true
            ]
        ]);
        $builder->setData($User->toArray());
        return $this->resData($builder);
    }
    public function getInfo(Request $request)
    {
        $User = User::where(['id' => $request->uid])->withoutField('password')->find();
        return $this->resData(User::getTokenInfo($User));
    }
    public function refresh()
    {
        return $this->event(ResponseEvent::UPDATE_USERINFO, '刷新成功');
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
}
