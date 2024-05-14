<?php

namespace app\expose\helper;

use app\expose\enum\PaymentChannels;
use app\expose\enum\Platform;
use app\expose\enum\State;
use app\model\PaymentConfig;
use app\model\PaymentTemplate;
use Exception;
use Yansongda\Pay\Pay;

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
    public static function platform($scene)
    {
        $platform = request()->platform;
        $PaymentConfig = PaymentConfig::where(['platform' => $platform, 'state' => State::YES['value']])->select();
        $payment_scene = Config::get('payment_scene', $scene);
        $data = [];
        foreach ($PaymentConfig as $item) {
            if (in_array($item->channels, $payment_scene)) {
                $temp = [
                    'id' => $item->id,
                    'label' => PaymentChannels::getText($item->channels),
                ];
                if ($item->is_default == State::YES['value']) {
                    $temp['default'] = 1;
                }
                $data[] = $temp;
            }
        }
        return $data;
    }
    public static function getIntegralName()
    {
        $integral = '积分';
        try {
            $platform = request()->platform;
            if (!$platform) {
                $platform = Platform::PC['value'];
            }
            $Payment = self::get($platform, PaymentChannels::INTEGRAL['value']);
            if (isset($Payment['display_name'])) {
                $integral = $Payment['display_name'];
            }
        } catch (\Throwable $th) {
        }
        return $integral;
    }
    public static function createPayment($model, $id)
    {
        $PaymentConfig = PaymentConfig::where(['id' => $id])->find();
        if (!$PaymentConfig) {
            throw new Exception('支付配置不存在');
        }
        switch ($PaymentConfig->channels) {
            case PaymentChannels::WXPAY['value']:
                return self::wxPay($model, $PaymentConfig);
            case PaymentChannels::ALIPAY['value']:
                break;
            case PaymentChannels::INTEGRAL['value']:
                break;
            case PaymentChannels::BALANCE['value']:
                break;
        }
        throw new \Exception('未知支付方式');
    }
    public static function wxPay($model, $PaymentConfig)
    {
        switch ($PaymentConfig->platform) {
            case Platform::PC['value']:
                return self::wxPayPc($model, $PaymentConfig);
            case Platform::H5['value']:
                return self::wxPayH5($model, $PaymentConfig);
            case Platform::WECHAT_OFFICIAL_ACCOUNT['value']:
                return self::wxPayOFFICIAL_ACCOUNT($model, $PaymentConfig);
            case Platform::APP['value']:
                return self::wxPayApp($model, $PaymentConfig);
            case Platform::WECHAT_MINIAPP['value']:
                return self::wxPayMiniapp($model, $PaymentConfig);
        }
    }
    public static function wxPayPc($model, $PaymentConfig)
    {
        $PaymentTemplate = PaymentTemplate::where(['id' => $PaymentConfig->template_id])->find();
        if (!$PaymentTemplate) {
            throw new Exception('支付模板不存在');
        }
        $Payment = $PaymentTemplate->value;
        $notify_url=$Payment['notify_url'];
        # 判断是否为“/”结尾
        if(substr($notify_url,-1)=='/'){
            $notify_url=substr($notify_url,0,-1);
        }
        $request=request();
        $notify_url.='/notify/wechat/'.$request->plugin.'/'.$PaymentTemplate->id;
        $config = [
            'wechat' => [
                'default' => [
                    // 必填-商户号
                    'mch_id' => $Payment['mch_id'],
                    // 选填-v2商户私钥
                    'mch_secret_key_v2' => '',
                    // 必填-v3商户秘钥
                    'mch_secret_key' => $Payment['mch_key'],
                    // 必填-商户私钥 字符串或路径
                    'mch_secret_cert' => base_path(Uploads::path($Payment['ssl_key'])),
                    // 必填-商户公钥证书路径
                    'mch_public_cert_path' => base_path(Uploads::path($Payment['ssl_cert'])),
                    // 必填
                    'notify_url' => $notify_url,
                    // 选填-公众号 的 app_id
                    'mp_app_id' => $Payment['appid'],
                    // 选填-默认为正常模式。可选为： MODE_NORMAL, MODE_SERVICE
                    'mode' => Pay::MODE_NORMAL,
                ]
            ],
            'logger' => [
                'enable' => false,
                'file' => runtime_path('logs/wechat.log'),
                'level' => 'debug', // 建议生产环境等级调整为 info，开发环境为 debug
                'type' => 'single', // optional, 可选 daily.
                'max_file' => 30, // optional, 当 type 为 daily 时有效，默认 30 天
            ],
            'http' => [
                'timeout' => 5.0,
                'connect_timeout' => 5.0,
            ],
        ];
        $order = [
            'out_trade_no' => $model->trade,
            'amount' => [
                'total' => getenv('DEV')==='true'?1:$model->price*100,
            ],
            'description' => $model->title,
            'time_expire'=>date('c', strtotime($model->expire_time)),
        ];
        $Pay = Pay::wechat($config)->scan($order);
        return [
            'trade' => $model->trade,
            'qrcode' => $Pay->code_url,
        ];
    }
    public static function wxPayH5($model, $PaymentConfig)
    {
    }
    public static function wxPayOFFICIAL_ACCOUNT($model, $PaymentConfig)
    {
    }
    public static function wxPayApp($model, $PaymentConfig)
    {
    }
    public static function wxPayMiniapp($model, $PaymentConfig)
    {
    }
}
