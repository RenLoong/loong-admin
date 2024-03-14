<?php

namespace app\expose\helper;

use app\model\PaymentConfig;
use app\model\PaymentTemplate;
use Exception;

class Payment
{
    public static function get($platform, $channels)
    {
        $PaymentConfig = PaymentConfig::where(['platform' => $platform, 'channels' => $channels])->find();
        if (!$PaymentConfig) {
            throw new Exception('支付配置不存在');
        }
        $PaymentTemplate = PaymentTemplate::where(['id' => $PaymentConfig->template_id])->find();
        if (!$PaymentTemplate) {
            throw new Exception('支付模板不存在');
        }
        return $PaymentTemplate->value;
    }
}
