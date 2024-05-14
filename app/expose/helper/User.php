<?php

namespace app\expose\helper;

use app\expose\enum\EventName;
use app\expose\utils\Rsa;
use app\model\User as ModelUser;
use Webman\Event\Event;

/**
 * 用户助手类
 * 
 * Class User
 * @package app\helper
 *
 * @method static ModelUser create(array $data)
 * @method static ModelUser register(array $data)
 * @method static ModelUser login(array $data)
 * @method static ModelUser update(int $uid, array $data)
 * @method static ModelUser info(int $uid)
 * @method static string getIcode(int $uid)
 * @method static int getUidByIcode(string $icode)
 * 
 */
class User
{
    /**
     * 创建用户
     *
     * @param array $data
     * @param string $data['username'] 用户名（唯一性），可登录
     * @param string $data['mobile'] 手机号（唯一性），可登录
     * @param string $data['email'] 邮箱
     * @param string $data['password'] 密码
     * @param string $data['activation_time'] 激活时间
     * 
     * @return ModelUser
     */
    public static function create($data)
    {
        $insterData = [];
        if (!empty($data['icode'])) {
            $insterData['puid'] = self::getUidByIcode($data['icode']);
        }
        if (empty($data['username']) && empty($data['mobile'])) {
            throw new \Exception('用户名、手机号至少填写一项');
        }
        if (!empty($data['username'])) {
            $Find = ModelUser::where(['username' => $data['username']])->find();
            if ($Find) {
                return $Find;
            }
            $insterData['username'] = $data['username'];
        }
        if (!empty($data['mobile'])) {
            $Find = ModelUser::where(['mobile' => $data['mobile']])->find();
            if ($Find) {
                return $Find;
            }
            $insterData['mobile'] = $data['mobile'];
        }
        if (!empty($data['email'])) {
            $insterData['email'] = $data['email'];
        }
        if (!empty($data['password'])) {
            $insterData['password'] = $data['password'];
        }
        if (!empty($data['activation_time'])) {
            $insterData['activation_time'] = $data['activation_time'];
        }
        if (!empty($data['nickname'])) {
            $insterData['nickname'] = $data['nickname'];
        }
        if (!empty($data['headimg'])) {
            $insterData['headimg'] = $data['headimg'];
        }
        $model = new ModelUser();
        $model->save($insterData);
        Event::emit(EventName::USER_REGISTER['value'], $model);
        return $model;
    }
    /**
     * 注册
     *
     * @param array $data
     * @param string $data['icode'] 邀请码
     * @param string $data['username'] 用户名（唯一性），可登录
     * @param string $data['mobile'] 手机号（唯一性），可登录
     * @param string $data['email'] 邮箱
     * @param string $data['password'] 密码
     * 
     * @return ModelUser
     */
    public static function register($data)
    {
        $data['activation_time'] = date('Y-m-d H:i:s');
        $request=request();
        if($request->icode){
            $data['icode'] = $request->icode;
        }
        return self::create($data);
    }
    /**
     * 更新
     *
     * @param int $uid 用户ID
     * @param array $data 更新数据
     * @param string $data['username'] 用户名
     * @param string $data['mobile'] 手机号
     * @param string $data['email'] 邮箱
     * @return ModelUser
     */
    public static function update($uid, $data)
    {
        $user = ModelUser::where(['id' => $uid])->find();
        if (!$user) {
            throw new \Exception('用户不存在');
        }
        if (!empty($data['password'])) {
            $user->password = $data['password'];
        }
        if (!empty($data['username'])) {
            $Find = ModelUser::where(['username' => $data['username']])->find();
            if ($Find && $Find->id != $uid) {
                throw new \Exception('用户名已存在');
            }
            $user->username = $data['username'];
        }
        if (!empty($data['mobile'])) {
            $Find = ModelUser::where(['mobile' => $data['mobile']])->find();
            if ($Find && $Find->id != $uid) {
                throw new \Exception('手机号已存在');
            }
            $user->mobile = $data['mobile'];
        }
        if (!empty($data['email'])) {
            $user->email = $data['email'];
        }
        if (!empty($data['nickname'])) {
            $user->nickname = $data['nickname'];
        }
        if (!empty($data['headimg'])) {
            $user->headimg = $data['headimg'];
        }
        $user->save();
        Event::emit(EventName::USER_UPDATE['value'], $user);
        return $user;
    }
    /**
     * 获取用户信息
     *
     * @param int $uid 用户ID
     * @return ModelUser
     */
    public static function info($uid)
    {
        $Find = ModelUser::where(['id' => $uid])->find();
        if (!$Find) {
            throw new \Exception('用户不存在');
        }
        return $Find;
    }
    /**
     * 获取邀请码
     *
     * @param int $uid 用户ID
     * @return string
     */
    public static function getIcode($uid)
    {
        $user = ModelUser::where(['id' => $uid])->find();
        return Rsa::encryptNumber($user->id);
    }
    /**
     * 邀请码换取用户ID
     * 
     * @param string $icode 邀请码
     * @return int
     */
    public static function getUidByIcode($icode)
    {
        return Rsa::decryptNumber($icode);
    }
}
