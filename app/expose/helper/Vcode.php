<?php

namespace app\expose\helper;

use app\expose\template\email\Vcode as EmailVcode;
use app\expose\template\sms\Vcode as SmsVcode;
use app\expose\utils\Email;
use app\expose\utils\Sms;
use app\expose\utils\Str;

class Vcode
{
    public static function check($username, $vcode, $scene, $token = null)
    {
        $request = request();
        if (!empty($token)) {
            $request->sessionId($token);
        }
        $vcodeData = $request->session()->get('vcode:' . $scene . ':' . $username);
        if (empty($vcodeData)) {
            return false;
        }
        if ($vcodeData['vcode'] != $vcode) {
            return false;
        }
        if ($vcodeData['expire'] < time()) {
            return false;
        }
        return true;
    }
    public static function send($username, $scene, $token = null)
    {
        $request = request();
        if (!empty($token)) {
            $request->sessionId($token);
        }
        $vcode = Str::random(6, 1);
        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            $Email = new Email;
            $Email->toemail = $username;
            $Email->setTemplate(EmailVcode::class);
            $Email->setData(['vcode' => $vcode]);
            $Email->send();
        } else {
            $request->session()->set('vcode:' . $scene . ':' . $username, [
                'vcode' => $vcode,
                'expire' => time() + 60 * 5
            ]);
            $Sms = new Sms;
            $Sms->mobile = $username;
            $Sms->setTemplate(SmsVcode::class);
            $Sms->setData(['code' => $vcode]);
            $Sms->send();
        }
    }
}
