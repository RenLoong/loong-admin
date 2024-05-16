<?php

namespace app\controller;

use app\expose\helper\Config;
use app\expose\utils\wechat\OfficialAccount;
use support\Request;

class WechatOfficialAccountController
{
    public function message(Request $request)
    {
        $OfficialAccount = new OfficialAccount();
        $config = Config::get('wechat_official_account');
        if (!$config['state']) {
            return 'wechat official account is not enabled';
        }
        try {
            $OfficialAccount->checkSignature($request, $config);
            if ($request->method() === 'GET') {
                return $request->get('echostr');
            }
        } catch (\Throwable $th) {
            if ($request->method() === 'GET') {
                return $th->getMessage();
            } else {
            }
        }
        return $OfficialAccount->handle($request,$config);
    }
}
