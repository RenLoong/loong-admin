<?php

namespace app\expose\utils\wechat;

use app\expose\utils\wechat\modules\Event;
use app\expose\utils\wechat\modules\Reply;

class OfficialAccount
{
    use Reply;
    use Event;
    public function handle($request, $config)
    {
        $data = $this->getData($request, $config);
        if ($data['MsgType'] === 'event') {
            return $this->handleEvent($data);
        } else {
            return $this->replyText($data, 'hello world');
        }
    }
    public function checkSignature($request, $config)
    {
        $signature = $request->get("signature");
        $timestamp = $request->get("timestamp");
        $nonce = $request->get("nonce");
        $token = $config['token'];
        $tmpArr = [$token, $timestamp, $nonce];
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);
        if ($tmpStr == $signature) {
            return true;
        }
        throw new \Exception('signature error');
    }
    private function getData($request, $config)
    {
        $xml = $request->rawBody();
        $json = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
        $data = json_decode(json_encode($json), true);
        if ($request->get('encrypt_type') === 'aes') {
            $Encrypt = base64_decode($data['Encrypt']);
            $aes_key = $config['aes_key'];
            $aes_key = base64_decode($aes_key . '=');
            $iv = substr($aes_key, 0, 16);
            $xml = openssl_decrypt($Encrypt, 'aes-256-cbc', $aes_key, OPENSSL_RAW_DATA, $iv);
            $filterHeader = substr($xml, 20);
            $xml = preg_replace('/' . $config['app_id'] . '/', '', $filterHeader);
            $json = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
            $data = json_decode(json_encode($json), true);
            return $data;
        } else {
            return $data;
        }
    }
}
