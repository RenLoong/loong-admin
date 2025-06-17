<?php

namespace app\admin\controller;

use app\Basic;
use app\expose\build\builder\TableBuilder;
use app\expose\enum\PaymentChannels;
use app\expose\enum\Platform;
use app\expose\enum\State;
use app\model\PaymentConfig;
use app\model\PaymentTemplate;
use support\Request;

class PaymentController extends Basic
{
    public function __construct()
    {
        $this->model = new PaymentConfig;
    }
    public function index(Request $request)
    {
        $tabs = [];
        $PaymentConfig = PaymentConfig::where([])->select();
        $Platform = Platform::getOptions();
        foreach ($Platform as $key => $item) {
            $channels = [];
            switch ($item['value']) {
                case Platform::PC['value']:
                    $channels = [
                        PaymentChannels::WXPAY,
                        PaymentChannels::ALIPAY,
                        PaymentChannels::BALANCE,
                        PaymentChannels::INTEGRAL
                    ];
                    break;
                case Platform::H5['value']:
                    $channels = [
                        PaymentChannels::WXPAY,
                        PaymentChannels::ALIPAY,
                        PaymentChannels::BALANCE,
                        PaymentChannels::INTEGRAL
                    ];
                    break;
                case Platform::WECHAT_MINIAPP['value']:
                    $channels = [
                        PaymentChannels::WXPAY,
                        PaymentChannels::BALANCE,
                        PaymentChannels::INTEGRAL
                    ];
                    break;
                case Platform::WECHAT_OFFICIAL_ACCOUNT['value']:
                    $channels = [
                        PaymentChannels::WXPAY,
                        PaymentChannels::BALANCE,
                        PaymentChannels::INTEGRAL
                    ];
                    break;
                case Platform::APP['value']:
                    $channels = [
                        PaymentChannels::WXPAY,
                        PaymentChannels::ALIPAY,
                        PaymentChannels::BALANCE,
                        PaymentChannels::INTEGRAL
                    ];
                    break;
            }
            $tabs[] = $this->getFormBuilder($PaymentConfig, $item, $channels);
        }
        return $this->resData($tabs);
    }
    public function getFormBuilder($PaymentConfig, $Platform, $channels)
    {
        $builder = new TableBuilder([
            'border' => false,
            'stripe' => false
        ]);
        $builder->add('channels', '支付方式', [
            'component' => [
                'name' => 'table-userinfo',
                'props' => [
                    'nickname' => 'channels_text',
                    'avatar' => [
                        'field' => 'channels_icon',
                        'size' => 40
                    ]
                ]
            ],
            'props' => []
        ]);
        $builder->add('template_id', '支付模板', [
            'component' => [
                'name' => 'select',
                'api' => 'Payment/indexUpdateField',
                'options' => PaymentTemplate::options(),
                'props' => [
                    'clearable' => true
                ]
            ],
            'props' => [
                'width' => '300px'
            ]
        ]);
        $builder->add('state', '是否启用', [
            'component' => [
                'name' => 'switch',
                'api' => 'Payment/indexUpdateState',
                'props' => [
                    'active-value' => State::YES['value'],
                    'inactive-value' => State::NO['value']
                ]
            ],
            'props' => [
                'width' => '160px'
            ]
        ]);
        $builder->add('is_default', '是否为默认支付', [
            'component' => [
                'name' => 'switch',
                'api' => 'Payment/indexUpdateState',
                'props' => [
                    'active-value' => State::YES['value'],
                    'inactive-value' => State::NO['value']
                ]
            ],
            'props' => [
                'width' => '160px'
            ]
        ]);
        $tableData = [];
        $exist = [];
        foreach ($PaymentConfig as $item) {
            if ($item->platform != $Platform['value']) continue;
            $temp = $item->toArray();
            $PaymentChannels = PaymentChannels::get($item->channels);
            if ($PaymentChannels) {
                $temp['channels_text'] = $PaymentChannels['label'];
                $temp['channels_icon'] = $PaymentChannels['icon'];
            }
            $exist[] = $item->channels;
            $tableData[] = $temp;
        }
        foreach ($channels as $key => $channel) {
            if (!in_array($channel['value'], $exist)) {
                $model = new PaymentConfig;
                $model->platform = $Platform['value'];
                $model->channels = $channel['value'];
                $model->state = State::NO['value'];
                $model->save();
                $tableData[] = [
                    'id' => $model->id,
                    'channels' => $channel['value'],
                    'channels_text' => $channel['label'],
                    'channels_icon' => $channel['icon'],
                    'template_id' => null,
                    'state' => State::NO['value'],
                    'is_default' => State::NO['value']
                ];
            }
        }
        $data = [
            'title' => $Platform['label'],
            'name' => $Platform['value'],
            'tips' => '在' . $Platform['label'] . '端付款时使用',
            'builder' => $builder,
            'data' => $tableData
        ];
        return $data;
    }
    public function indexUpdateState(Request $request)
    {
        $id = $request->post('id');
        $field = $request->post('field');
        $value = $request->post('value');
        $PaymentConfig = PaymentConfig::where(['id' => $id])->find();
        if (!$PaymentConfig) {
            return $this->fail('数据不存在');
        }
        if ($field == 'is_default' && $value == State::YES['value']) {
            $PaymentConfig->where(['platform' => $PaymentConfig->platform])->update(['is_default' => State::NO['value']]);
        }
        $PaymentConfig->{$field} = $value;
        if ($PaymentConfig->save()) {
            return $this->success();
        }
        return $this->fail('操作失败');
    }
}
