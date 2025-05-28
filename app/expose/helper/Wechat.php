<?php

namespace app\expose\helper;

use GuzzleHttp\Client;
use support\Redis;

class Wechat
{
    /**
     * QR_SCENE
     * 临时的整型参数值
     * @var string
     */
    const QR_SCENE = 'QR_SCENE';
    /**
     * QR_STR_SCENE
     * 临时的字符串参数值
     * @var string
     */
    const QR_STR_SCENE = 'QR_STR_SCENE';
    /**
     * QR_LIMIT_SCENE
     * 永久的整型参数值
     * @var string
     */
    const QR_LIMIT_SCENE = 'QR_LIMIT_SCENE';
    /**
     * QR_LIMIT_STR_SCENE
     * 永久的字符串参数值
     * @var string
     */
    const QR_LIMIT_STR_SCENE = 'QR_LIMIT_STR_SCENE';
    public static function getAccessToken()
    {
        $config = new Config('wechat_official_account', '');
        $access_token = Redis::get('wechat_official_account_access_token');
        if ($access_token) {
            return $access_token;
        }
        if (!$config['state']) {
            throw new \Exception('请先开启公众号');
        }
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$config['app_id']}&secret={$config['app_secret']}";
        try {
            $client = new Client();
            $response = $client->get($url);
            $data = json_decode($response->getBody()->getContents(), true);
            if (isset($data['errcode'])) {
                throw new \Exception($data['errmsg']);
            }
            Redis::set('wechat_official_account_access_token', $data['access_token'], 'EX', $data['expires_in']);
            return $data['access_token'];
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    /**
     * 创建公众号二维码
     *
     * @param string $action_name QR_SCENE为临时的整型参数值，QR_STR_SCENE为临时的字符串参数值，QR_LIMIT_SCENE为永久的整型参数值，QR_LIMIT_STR_SCENE为永久的字符串参数值
     * @param int $expire 二维码有效时间，以秒为单位。最大不超过2592000（即30天）
     * @param array $eventData 回调事件数据
     * @param Class $eventData[0] 回调事件类
     * @param string $eventData[1] 回调事件方法
     * @param array $eventData[2] 回调事件参数,会在回调事件方法中$data.params原样传入
     * @return array $data
     * @return string $data['url'] 二维码图片地址
     * @return string $data['id'] 二维码id，在回调事件中$data['EventKey']
     * @return int $data['expire_seconds'] 二维码有效时间
     * @throws \Exception
     */
    public static function createQrCode($action_name, $expire, $eventData)
    {
        $request = request();
        $id = $request->sessionId();
        if(count($eventData)<2){
            throw new \Exception('回调事件数据不完整');
        }
        $access_token = self::getAccessToken();
        $url = 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=' . $access_token;
        $client = new Client();
        $data = [
            'expire_seconds' => $expire,
            'action_name' => $action_name,
            'action_info' => [
                'scene' => []
            ]
        ];
        if (in_array($action_name, [self::QR_SCENE, self::QR_LIMIT_SCENE])) {
            $data['action_info']['scene'] = ['scene_id' => $id];
        } else {
            $data['action_info']['scene'] = ['scene_str' => $id];
        }
        Redis::set($id, json_encode($eventData, JSON_UNESCAPED_UNICODE), 'EX', $expire + 60);
        $response = $client->post($url, [
            'json' => $data
        ]);
        $res = json_decode($response->getBody()->getContents(), true);
        if (isset($res['errcode'])) {
            throw new \Exception($res['errmsg']);
        }
        $res['id'] = $id;
        return $res;
    }
    /**
     * 发送模板消息
     *
     * @param mixed $params 模板消息参数
     * @return string
     */
    public static function sendTemplate($params)
    {
        $access_token = self::getAccessToken();
        $url = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=' . $access_token;
        $client = new Client([
            'content_type' => 'application/json',
        ]);
        $response = $client->post($url, ['body' => json_encode($params, JSON_UNESCAPED_UNICODE)]);
        $data = json_decode($response->getBody()->getContents(), true);
        if (empty($data['msgid'])) {
            throw new \Exception("[{$data['errcode']}]" . $data['errmsg']);
        }
        return $data['msgid'];
    }
}
