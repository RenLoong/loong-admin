<?php

namespace app\expose\helper;

use GuzzleHttp\Client;
use support\Redis;

class Wechat
{
    public static function getAccessToken()
    {
        $config=new Config('wechat_official_account','');
        $access_token=Redis::get('wechat_official_account_access_token');
        if($access_token){
            return $access_token;
        }
        if(!$config['state']){
            throw new \Exception('请先开启公众号');
        }
        $url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$config['app_id']}&secret={$config['app_secret']}";
        try {
            $client=new Client();
            $response=$client->get($url);
            $data=json_decode($response->getBody()->getContents(),true);
            if(isset($data['errcode'])){
                throw new \Exception($data['errmsg']);
            }
            Redis::set('wechat_official_account_access_token',$data['access_token'],'EX',$data['expires_in']);
            return $data['access_token'];
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public static function createQrCode($data)
    {
        $access_token = self::getAccessToken();
        $url='https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.$access_token;
        $client=new Client();
        $response=$client->post($url,[
            'json'=>$data
        ]);
        $res=json_decode($response->getBody()->getContents(),true);
        if(isset($res['errcode'])){
            throw new \Exception($res['errmsg']);
        }
        return $res;
    }
}