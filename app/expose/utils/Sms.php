<?php

namespace app\expose\utils;

use app\expose\enum\SmsChannels;
use Exception;

use AlibabaCloud\SDK\Dysmsapi\V20170525\Dysmsapi;
use Darabonba\OpenApi\Models\Config;
use AlibabaCloud\SDK\Dysmsapi\V20170525\Models\SendSmsRequest;
use AlibabaCloud\Tea\Utils\Utils\RuntimeOptions;

class Sms
{
    public $mobile;
    protected $data;
    protected $template;
    public function setTemplate($template)
    {
        $this->template = new $template;
        return $this;
    }
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }
    public function send()
    {
        $this->template->builder($this->mobile, $this->data);
        switch ($this->template->channels) {
            case SmsChannels::ALIYUN['value']:
                $this->sendAliyun();
                break;
            case SmsChannels::TENCENT['value']:
                $this->sendTencent();
                break;
            default:
                throw new Exception("未知的短信服务商");
        }
    }
    public function sendAliyun()
    {
        if (empty($this->template->config)) {
            throw new Exception("阿里云短信服务商配置不完整");
        }
        $config = new Config([
            "accessKeyId" => $this->template->config['access_key_id'],
            "accessKeySecret" => $this->template->config['access_secret'],
        ]);
        $config->endpoint = "dysmsapi.aliyuncs.com";
        $client = new Dysmsapi($config);
        $request = new SendSmsRequest([
            "phoneNumbers" => $this->mobile,
            "templateCode" => $this->template->templateCode,
            "templateParam" => json_encode($this->data, JSON_UNESCAPED_UNICODE),
            "signName" => $this->template->config['sign_name']
        ]);
        $runtime                 = new RuntimeOptions();
        $runtime->maxIdleConns   = 3;
        $runtime->connectTimeout = 10000;
        $runtime->readTimeout    = 10000;
        // 复制代码运行请自行打印 API 的返回值
        $res = $client->sendSms($request, $runtime);
        if ($res->body->code == 'OK') {
            return true;
        }
        if ($res->body->message) {
            throw new Exception($res->body->message);
        }
        throw new Exception("发送失败");
    }
    public function sendTencent()
    {
    }
}
