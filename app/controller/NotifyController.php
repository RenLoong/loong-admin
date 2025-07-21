<?php

namespace app\controller;

use app\expose\enum\EventName;
use app\expose\enum\PaymentChannels;
use app\expose\helper\Uploads;
use app\expose\trait\Json;
use app\model\PaymentNotifyWechat;
use app\model\PaymentTemplate;
use Exception;
use support\Log;
use support\Request;
use think\facade\Db;
use Webman\Event\Event;
use Yansongda\Pay\Pay;

class NotifyController
{
    use Json;
    public function wechat(Request $request,$plugin,$template_id)
    {
        Log::info('微信支付回调',$request->post());
        try {
            $D=$request->post();
            if(PaymentNotifyWechat::where(['notify_id'=>$D['id']])->count()){
                return $this->code('SUCCESS','成功');
            }
            $PaymentTemplate = PaymentTemplate::where(['id' => $template_id])->find();
            if (!$PaymentTemplate) {
                throw new Exception('支付模板不存在');
            }
            $Payment = $PaymentTemplate->value;
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
                        'notify_url' => $Payment['notify_url'],
                        // 选填-公众号 的 app_id
                        'mp_app_id' => $Payment['appid'],
                        // 选填-默认为正常模式。可选为： MODE_NORMAL, MODE_SERVICE
                        'mode' => Pay::MODE_NORMAL,
                    ]
                ],
                'logger' => [
                    'enable' => true,
                    'file' => runtime_path('logs/wechat-notify-'.date('Y-m-d').'.log'),
                    'level' => 'info', // 建议生产环境等级调整为 info，开发环境为 debug
                    'type' => 'single', // optional, 可选 daily.
                    'max_file' => 30, // optional, 当 type 为 daily 时有效，默认 30 天
                ],
                'http' => [
                    'timeout' => 5.0,
                    'connect_timeout' => 5.0,
                ],
            ];
            $wxpay=Pay::wechat($config);
            $data = $wxpay->callback($D);
            $obj=null;
            Db::startTrans();
            try {
                $PaymentNotifyWechat=new PaymentNotifyWechat;
                $PaymentNotifyWechat->notify_id=$D['id'];
                $PaymentNotifyWechat->resource_type=$D['resource_type'];
                $PaymentNotifyWechat->event_type=$D['event_type'];
                $PaymentNotifyWechat->summary=$D['summary'];
                $PaymentNotifyWechat->resource_original_type=$D['resource']['original_type'];
                $PaymentNotifyWechat->resource_algorithm=$D['resource']['algorithm'];
                $PaymentNotifyWechat->resource_ciphertext=$D['resource']['ciphertext'];
                $PaymentNotifyWechat->resource_associated_data=$D['resource']['associated_data'];
                $PaymentNotifyWechat->resource_nonce=$D['resource']['nonce'];
                $PaymentNotifyWechat->plugin=$plugin;
                $PaymentNotifyWechat->template_id=$template_id;
                $PaymentNotifyWechat->save();
                $class="plugin\\{$plugin}\\api\\notify\\Wechat";
                if(class_exists($class)){
                    $obj=new $class;
                    $obj->{$data->resource['original_type']}($data->resource['ciphertext']);
                }else{
                    Event::emit(EventName::ORDERS_PAY['value'], [
                        'data'=>$data->resource['ciphertext'],
                        'payment_channel'=>PaymentChannels::WXPAY['value'],
                        'plugin'=>$plugin,
                        'template_id'=>$template_id
                    ]);
                }
                Db::commit();
            } catch (\Throwable $th) {
                Db::rollback();
                throw $th;
            }
            if($obj&&method_exists($obj,'finish')){
                $obj->finish();
            }
        } catch (\Throwable $th) {
            Log::error('微信支付回调错误:'.$th->getMessage(),$th->getTrace());
            return $this->json(['code'=>'FAIL','message'=>$th->getMessage()],JSON_UNESCAPED_UNICODE,400);
        }
        return $this->code('SUCCESS','成功');
    }
}