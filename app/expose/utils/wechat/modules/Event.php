<?php
namespace app\expose\utils\wechat\modules;

use app\expose\enum\EventName;
use app\expose\enum\State;
use app\model\User;
use app\model\UserWechat;
use support\Redis;
use Webman\Event\Event as EventEvent;

trait Event
{
    private function handleEvent($data)
    {
        p($data);
        switch($data['Event'])
        {
            case 'subscribe':
                $UserWechat=UserWechat::where('openid',$data['FromUserName'])->find();
                if($UserWechat)
                {
                    $UserWechat->subscribe=State::YES['value'];
                    $UserWechat->save();
                    if($UserWechat->uid){
                        $User=User::where('id',$UserWechat->uid)->find();
                        return $this->replyText($data,'欢迎回来：'.$User->nickname);
                    }
                    return $this->replyText($data,'欢迎关注：'.$UserWechat->nickname);
                }
                $UserWechat=new UserWechat();
                $UserWechat->openid=$data['FromUserName'];
                $UserWechat->subscribe=State::YES['value'];
                $UserWechat->save();
                return $this->replyText($data,'欢迎关注');
            case 'unsubscribe':
                $UserWechat=UserWechat::where('openid',$data['FromUserName'])->find();
                if($UserWechat)
                {
                    $UserWechat->subscribe=State::NO['value'];
                    $UserWechat->save();
                }
                return $this->replyText($data,'路远，再会。');
            case 'SCAN':
                $Scene=Redis::get($data['EventKey']);
                if($Scene){
                    $Scene=json_decode($Scene,true);
                    if(count($Scene)<2)
                    {
                        return $this->replyText($data,'二维码参数错误');
                    }
                    $class=$Scene[0];
                    $method=$Scene[1];
                    if(class_exists($class)){
                        $class=new $class();
                        if(method_exists($class,$method)){
                            if(isset($Scene[2]))
                            {
                                $data['params']=$Scene[2];
                            }
                            return $class->$method($data);
                        }
                    }
                    return $this->replyText($data,'扫码成功,但未找到对应处理类或方法');
                }
                return $this->replyText($data,'二维码已过期');
            case 'LOCATION':
                return $this->replyText($data,'上报地理位置');
            case 'CLICK':
                return $this->replyText($data,'点击菜单');
            case 'VIEW':
                return $this->replyText($data,'点击菜单跳转链接');
            case 'scancode_push':
                return $this->replyText($data,'扫码推事件');
            case 'scancode_waitmsg':
                return $this->replyText($data,'扫码推事件且弹出“消息接收中”提示框');
            case 'pic_sysphoto':
                return $this->replyText($data,'弹出系统拍照发图');
            case 'pic_photo_or_album':
                return $this->replyText($data,'弹出拍照或者相册发图');
            case 'pic_weixin':
                return $this->replyText($data,'弹出微信相册发图器');
            case 'location_select':
                return $this->replyText($data,'弹出地理位置选择器');
            case 'view_miniprogram':
                return $this->replyText($data,'点击菜单跳转小程序');
        }
    }
}