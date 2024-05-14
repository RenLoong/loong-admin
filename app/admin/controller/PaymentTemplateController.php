<?php

namespace app\admin\controller;

use app\Basic;
use app\expose\build\builder\ComponentBuilder;
use app\expose\build\builder\FormBuilder;
use app\expose\build\builder\TableBuilder;
use app\expose\enum\Action;
use app\expose\enum\AlipayRsaModel;
use app\expose\enum\PaymentChannels;
use app\expose\enum\State;
use app\expose\enum\WxpayMchType;
use app\expose\enum\WxpayVersion;
use app\model\PaymentTemplate;
use support\Request;

class PaymentTemplateController extends Basic
{
    public function indexGetTable(Request $request)
    {
        $builder = new TableBuilder;
        $builder->addAction('操作', [
            'width' => '200px',
            'fixed' => 'right'
        ]);
        $builder->addTableAction('编辑', [
            'path' => 'PaymentTemplate/update',
            'props' => [
                'type' => 'primary',
                'title' => '编辑《{title}》支付模板'
            ],
            'component' => [
                'name' => 'button',
                'props' => [
                    'type' => 'primary',
                    'size' => 'small'
                ]
            ]
        ]);
        $builder->addTableAction('删除', [
            'model' => Action::COMFIRM['value'],
            'path' => 'PaymentTemplate/delete',
            'props' => [
                'type' => 'error',
                'message' => '确定要删除《{title}》支付模板吗？',
                'confirmButtonClass' => 'el-button--danger'
            ],
            'component' => [
                'name' => 'button',
                'props' => [
                    'type' => 'danger',
                    'size' => 'small'
                ]
            ]
        ]);
        $builder->addHeader();
        $builder->addHeaderAction('新增模板', [
            'path' => 'PaymentTemplate/create',
            'props' => [
                'type' => 'success',
                'title' => '新增支付模板'
            ],
            'component' => [
                'name' => 'button',
                'props' => [
                    'type' => 'success',
                    'icon' => 'Plus'
                ]
            ]
        ]);
        $builder->add('id', 'ID', [
            'props' => [
                'width' => '80px'
            ]
        ]);
        $builder->add('title', '模板名称');
        $builder->add('channels', '支付方式', [
            'component' => [
                'name' => 'tag',
                'options' => PaymentChannels::getOptions()
            ],
            'props' => [
                'width' => '160px'
            ]
        ]);
        $builder->add('state', '状态', [
            'component' => [
                'name' => 'switch',
                'api' => 'PaymentTemplate/indexUpdateState',
                'props' => [
                    'active-value' => State::YES['value'],
                    'inactive-value' => State::NO['value']
                ]
            ],
            'props' => [
                'width' => '100px'
            ]
        ]);
        $builder->add('create_time', '时间', [
            'props' => [
                'width' => '200px'
            ],
            'component' => [
                'name' => 'table-times',
                'props' => [
                    'group' => [
                        [
                            'field' => 'create_time',
                            'label' => '创建'
                        ],
                        [
                            'field' => 'update_time',
                            'label' => '更新'
                        ]
                    ]
                ]
            ]
        ]);
        return $this->resData($builder);
    }
    public function index(Request $request)
    {
        $limit = $request->get('limit', 10);
        $where = [];
        $list = PaymentTemplate::where($where)->withoutField('value')
            ->order('id desc')->paginate($limit)->each(function ($item) {
            });
        return $this->resData($list);
    }
    public function create(Request $request)
    {
        if ($request->method() === 'POST') {
            $D = $request->post();
            $model = new PaymentTemplate;
            $model->title = $D['title'];
            unset($D['title']);
            $model->channels = $D['channels'];
            unset($D['channels']);
            $model->state = State::YES['value'];
            $model->value = $this->getValue($model->channels, $D);
            if ($model->save()) {
                return $this->success('新增成功');
            }
            return $this->fail('新增失败');
        }
        $builder = $this->formBuilder();
        return $this->resData($builder);
    }
    public function update(Request $request)
    {
        if ($request->method() === 'POST') {
            $D = $request->post();
            $model = PaymentTemplate::where(['id' => $D['id']])->find();
            if (!$model) {
                return $this->fail('数据不存在');
            }
            unset($D['id']);
            $model->title = $D['title'];
            unset($D['title']);
            $model->channels = $D['channels'];
            unset($D['channels']);
            $model->state = State::YES['value'];
            $model->value = $this->getValue($model->channels, $D);
            if ($model->save()) {
                return $this->success('更新成功');
            }
            return $this->fail('更新失败');
        }
        $id = $request->get('id');
        $model = PaymentTemplate::where(['id' => $id])->find();
        if (!$model) {
            return $this->fail('数据不存在');
        }
        $builder = $this->formBuilder(true);
        $data = [
            'id' => $model->id,
            'title' => $model->title,
            'channels' => $model->channels
        ];
        foreach ($model->value as $key => $value) {
            $data[$key] = $value;
        }
        $builder->setData($data);
        return $this->resData($builder);
    }
    public function getValue($channels, $D)
    {
        $value = [];
        switch ($channels) {
            case PaymentChannels::WXPAY['value']:
                $value = [
                    'mch_type' => $D['mch_type'],
                    'appid' => $D['appid'],
                    'mch_id' => $D['mch_id'],
                    'mch_key' => $D['mch_key'],
                    'ssl_cert' => $D['ssl_cert'],
                    'ssl_key' => $D['ssl_key'],
                    'notify_url' => $D['notify_url'],
                ];
                break;
            case PaymentChannels::ALIPAY['value']:
                $value = [
                    'appid' => $D['appid'],
                    'ras_model' => $D['ras_model'],
                    'app_public_cert' => $D['app_public_cert'],
                    'alipay_public_cert' => $D['alipay_public_cert'],
                    'alipay_root_cert' => $D['alipay_root_cert'],
                    'alipay_public_key' => $D['alipay_public_key'],
                    'private_key' => $D['private_key'],
                    'notify_url' => $D['notify_url'],
                ];
                break;
            case PaymentChannels::INTEGRAL['value']:
                $value = [
                    'display_name' => $D['display_name'],
                    'proportion' => $D['proportion'],
                    'is_integer' => $D['is_integer'],
                    'integer' => $D['integer']
                ];
                break;
        }
        return $value;
    }
    public function formBuilder($update = false)
    {
        $builder = new FormBuilder(null, '', [
            'labelWidth' => '300px',
            'labelPosition' => 'right'
        ]);
        $Component = new ComponentBuilder;
        $builder->add('title', '模板名称', 'input', null, [
            'required' => true,
            'prompt' => [
                $Component->add('text', ['default' => '仅用于后台管理使用，对前台用户不可见；例如：H5-支付宝支付；微信小程序-微信支付'], ['type' => 'info', 'size' => 'small'])
                    ->builder()
            ],
            'props' => [
                'type' => 'text',
                'placeholder' => '请输入模板名称'
            ]
        ]);
        $builder->add('channels', '支付方式', 'radio', PaymentChannels::WXPAY['value'], [
            'required' => true,
            'prompt' => [
                $Component->add('text', ['default' => '保存以后支付方式将不可修改，请谨慎操作，'], ['type' => 'info', 'size' => 'small'])
                    ->add('link', ['default' => '微信商户平台'], ['type' => 'success', 'href' => 'https://pay.weixin.qq.com', 'target' => '_blank', 'underline' => false, 'size' => 'small'])
                    ->add('text', ['default' => '，'], ['type' => 'info', 'size' => 'small'])
                    ->add('link', ['default' => '支付宝开放平台'], ['type' => 'primary', 'href' => 'https://alipay.com', 'target' => '_blank', 'underline' => false, 'size' => 'small'])
                    ->builder()
            ],
            'options' => PaymentChannels::getOptions(),
            'props' => [
                'disabled' => $update
            ],
            'subProps' => [
                'border' => true
            ]
        ]);

        # 微信支付开始
        /* $builder->add('api_version', '微信支付接口版本', 'radio', WxpayVersion::V3['value'], [
            'required' => true,
            'where' => [
                ['channels', '=', PaymentChannels::WXPAY['value']]
            ],
            'options' => WxpayVersion::getOptions(),
            'subProps' => [
                'border' => true
            ]
        ]); */
        $builder->add('mch_type', '微信商户号类型', 'radio', WxpayMchType::NORMAL['value'], [
            'required' => true,
            'where' => [
                ['channels', '=', PaymentChannels::WXPAY['value']]
            ],
            'options' => WxpayMchType::getOptions(),
            'subProps' => [
                'border' => true
            ]
        ]);
        $builder->add('appid', '应用ID (AppID)', 'input', null, [
            'required' => true,
            'where' => [
                ['channels', '=', PaymentChannels::WXPAY['value']],
                ['mch_type', '=', WxpayMchType::NORMAL['value']]
            ],
            'prompt' => [
                $Component->add('text', ['default' => '微信小程序或者微信公众号的APPID，需要在哪个客户端支付就填写哪个，APP支付需要填写开放平台的应用APPID'], ['type' => 'info', 'size' => 'small'])
                    ->builder()
            ],
            'props' => [
                'type' => 'text',
                'placeholder' => '请输入应用ID (AppID)'
            ]
        ]);
        $builder->add('mch_id', '微信商户号 (MchId)', 'input', null, [
            'required' => true,
            'where' => [
                ['channels', '=', PaymentChannels::WXPAY['value']],
                ['mch_type', '=', WxpayMchType::NORMAL['value']]
            ],
            'prompt' => [
                $Component->add('text', ['default' => '微信支付的商户号，纯数字格式；例如：1600000109'], ['type' => 'info', 'size' => 'small'])
                    ->builder()
            ],
            'props' => [
                'type' => 'text',
                'placeholder' => '请输入微信商户号 (MchId)'
            ]
        ]);
        $builder->add('mch_key', '支付密钥 (APIKEY)', 'input', null, [
            'required' => true,
            'where' => [
                ['channels', '=', PaymentChannels::WXPAY['value']],
                ['mch_type', '=', WxpayMchType::NORMAL['value']]
            ],
            'prompt' => [
                $Component->add('text', ['default' => '微信支付商户平台 - 账户中心 - API安全 - 设置APIv3密钥'], ['type' => 'info', 'size' => 'small'])
                    ->builder()
            ],
            'props' => [
                'type' => 'text',
                'placeholder' => '请输入支付密钥 (APIKEY)'
            ]
        ]);
        $builder->add('ssl_cert', '证书文件 (CERT)', 'bundle', '', [
            'required' => true,
            'where' => [
                ['channels', '=', PaymentChannels::WXPAY['value']],
                ['mch_type', '=', WxpayMchType::NORMAL['value']]
            ],
            'props' => [
                'view' => 'file',
                'multiple' => 1
            ]
        ]);
        $builder->add('ssl_key', '证书文件 (KEY)', 'bundle', '', [
            'required' => true,
            'where' => [
                ['channels', '=', PaymentChannels::WXPAY['value']],
                ['mch_type', '=', WxpayMchType::NORMAL['value']]
            ],
            'props' => [
                'view' => 'file',
                'multiple' => 1
            ]
        ]);
        # 微信支付结束

        # 微信支付服务商模式开始
        $builder->add('service_appid', '服务商应用ID (AppID)', 'input', null, [
            'required' => true,
            'where' => [
                ['channels', '=', PaymentChannels::WXPAY['value']],
                ['mch_type', '=', WxpayMchType::SERVICE['value']]
            ],
            'prompt' => [
                $Component->add('text', ['default' => '请填写微信支付服务商的AppID'], ['type' => 'info', 'size' => 'small'])
                    ->builder()
            ],
            'props' => [
                'type' => 'text',
                'placeholder' => '请输入服务商应用ID (AppID)'
            ]
        ]);
        $builder->add('service_mch_id', '服务商户号 (MchId)', 'input', null, [
            'required' => true,
            'where' => [
                ['channels', '=', PaymentChannels::WXPAY['value']],
                ['mch_type', '=', WxpayMchType::SERVICE['value']]
            ],
            'prompt' => [
                $Component->add('text', ['default' => '微信支付服务商的商户号，纯数字格式；例如：1600000109'], ['type' => 'info', 'size' => 'small'])
                    ->builder()
            ],
            'props' => [
                'type' => 'text',
                'placeholder' => '请输入服务商户号 (MchId)'
            ]
        ]);
        $builder->add('service_mch_key', '服务商密钥 (APIKEY)', 'input', null, [
            'required' => true,
            'where' => [
                ['channels', '=', PaymentChannels::WXPAY['value']],
                ['mch_type', '=', WxpayMchType::SERVICE['value']]
            ],
            'prompt' => [
                $Component->add('text', ['default' => '微信支付商户平台 - 账户中心 - API安全 - 设置API密钥'], ['type' => 'info', 'size' => 'small'])
                    ->builder()
            ],
            'props' => [
                'type' => 'text',
                'placeholder' => '请输入服务商密钥 (APIKEY)'
            ]
        ]);
        $builder->add('appid', '子商户应用ID (AppID)', 'input', null, [
            'required' => true,
            'where' => [
                ['channels', '=', PaymentChannels::WXPAY['value']],
                ['mch_type', '=', WxpayMchType::SERVICE['value']]
            ],
            'prompt' => [
                $Component->add('text', ['default' => '微信小程序或者微信公众号的APPID，需要在哪个客户端支付就填写哪个，APP支付需要填写开放平台的应用APPID'], ['type' => 'info', 'size' => 'small'])
                    ->builder()
            ],
            'props' => [
                'type' => 'text',
                'placeholder' => '请输入子商户应用ID (AppID)'
            ]
        ]);
        $builder->add('mch_id', '子商户号 (MchId)', 'input', null, [
            'required' => true,
            'where' => [
                ['channels', '=', PaymentChannels::WXPAY['value']],
                ['mch_type', '=', WxpayMchType::SERVICE['value']]
            ],
            'prompt' => [
                $Component->add('text', ['default' => '微信支付的商户号，纯数字格式；例如：1600000109'], ['type' => 'info', 'size' => 'small'])
                    ->builder()
            ],
            'props' => [
                'type' => 'text',
                'placeholder' => '请输入子商户号 (MchId)'
            ]
        ]);
        $builder->add('service_ssl_cert', '服务商证书文件 (CERT)', 'bundle', '', [
            'required' => true,
            'where' => [
                ['channels', '=', PaymentChannels::WXPAY['value']],
                ['mch_type', '=', WxpayMchType::SERVICE['value']]
            ],
            'props' => [
                'view' => 'file',
                'multiple' => 1
            ]
        ]);
        $builder->add('service_ssl_key', '服务商证书文件 (KEY)', 'bundle', '', [
            'required' => true,
            'where' => [
                ['channels', '=', PaymentChannels::WXPAY['value']],
                ['mch_type', '=', WxpayMchType::SERVICE['value']]
            ],
            'props' => [
                'accept' => 'application/octet-stream',
                'view' => 'file',
                'multiple' => 1
            ]
        ]);
        # 微信支付服务商模式结束

        # 支付宝支付开始
        $builder->add('appid', '支付宝应用 (AppID)', 'input', null, [
            'required' => true,
            'where' => [
                ['channels', '=', PaymentChannels::ALIPAY['value']]
            ],
            'prompt' => [
                $Component->add('text', ['default' => '支付宝分配给开发者的应用ID；例如：2021072300007148'], ['type' => 'info', 'size' => 'small'])
                    ->builder()
            ],
            'props' => [
                'type' => 'text',
                'placeholder' => '请输入支付宝应用 (AppID)'
            ]
        ]);
        $builder->add('ras_model', '加签模式', 'radio', AlipayRsaModel::PUBLIC_CERT['value'], [
            'required' => true,
            'where' => [
                ['channels', '=', PaymentChannels::ALIPAY['value']]
            ],
            'prompt' => [
                $Component->add('text', ['default' => '如需使用资金支出类的接口，则必须使用公钥证书模式'], ['type' => 'info', 'size' => 'small'])
                    ->builder()
            ],
            'options' => AlipayRsaModel::getOptions(),
            'subProps' => [
                'border' => true
            ]
        ]);
        $builder->add('app_public_cert', '应用公钥证书', 'bundle', '', [
            'required' => true,
            'where' => [
                ['channels', '=', PaymentChannels::ALIPAY['value']],
                ['ras_model', '=', AlipayRsaModel::PUBLIC_CERT['value']]
            ],
            'prompt' => [
                $Component->add('text', ['default' => '请上传 "appCertPublicKey_xxxxxxxx.crt" 文件'], ['type' => 'info', 'size' => 'small'])
                    ->builder()
            ],
            'props' => [
                'view' => 'file',
                'multiple' => 1
            ]
        ]);
        $builder->add('alipay_public_cert', '支付宝公钥证书', 'bundle', '', [
            'required' => true,
            'where' => [
                ['channels', '=', PaymentChannels::ALIPAY['value']],
                ['ras_model', '=', AlipayRsaModel::PUBLIC_CERT['value']]
            ],
            'prompt' => [
                $Component->add('text', ['default' => '请上传 "alipayCertPublicKey_RSA2.crt" 文件'], ['type' => 'info', 'size' => 'small'])
                    ->builder()
            ],
            'props' => [
                'view' => 'file',
                'multiple' => 1
            ]
        ]);
        $builder->add('alipay_root_cert', '支付宝根证书', 'bundle', '', [
            'required' => true,
            'where' => [
                ['channels', '=', PaymentChannels::ALIPAY['value']],
                ['ras_model', '=', AlipayRsaModel::PUBLIC_CERT['value']]
            ],
            'prompt' => [
                $Component->add('text', ['default' => '请上传 "alipayRootCert.crt" 文件'], ['type' => 'info', 'size' => 'small'])
                    ->builder()
            ],
            'props' => [
                'view' => 'file',
                'multiple' => 1
            ]
        ]);
        $builder->add('alipay_public_key', '支付宝公钥 (alipayPublicKey)', 'input', '', [
            'required' => true,
            'where' => [
                ['channels', '=', PaymentChannels::ALIPAY['value']],
                ['ras_model', '=', AlipayRsaModel::PUBLIC_KEY['value']]
            ],
            'prompt' => [
                $Component->add('text', ['default' => '可在 "支付宝开放平台" - "应用信息" - "接口加签方式" - "支付宝公钥" 中复制'], ['type' => 'info', 'size' => 'small'])
                    ->builder()
            ],
            'props' => [
                'type' => 'textarea',
                'autosize' => [
                    'minRows' => 4,
                    'maxRows' => 6
                ],
                'placeholder' => '请输入支付宝公钥 (alipayPublicKey)'
            ]
        ]);
        $builder->add('private_key', '应用私钥 (privateKey)', 'input', '', [
            'required' => true,
            'where' => [
                ['channels', '=', PaymentChannels::ALIPAY['value']]
            ],
            'prompt' => [
                $Component->add('text', ['default' => '查看 "应用私钥RSA2048-敏感数据，请妥善保管.txt" 文件，将全部内容复制到此处'], ['type' => 'info', 'size' => 'small'])
                    ->builder()
            ],
            'props' => [
                'type' => 'textarea',
                'autosize' => [
                    'minRows' => 4,
                    'maxRows' => 6
                ],
                'placeholder' => '请输入应用私钥 (privateKey)'
            ]
        ]);
        $builder->add('display_name', '显示名称', 'input', null, [
            'required' => true,
            'where' => [
                ['channels', '=', PaymentChannels::INTEGRAL['value']]
            ],
            'prompt' => [
                $Component->add('text', ['default' => '在客户端显示的名称'], ['type' => 'info', 'size' => 'small'])
                    ->builder()
            ],
            'props' => [
                'type' => 'text',
                'placeholder' => '请输入显示名称'
            ]
        ]);
        $builder->add('proportion', '充值比例', 'input-number', null, [
            'required' => true,
            'where' => [
                ['channels', '=', PaymentChannels::INTEGRAL['value']]
            ],
            'prompt' => [
                $Component->add('text', ['default' => '1元=多少积分'], ['type' => 'info', 'size' => 'small'])
                    ->builder()
            ],
            'props' => [
                'controls' => false,
                'min' => 1,
                'max' => 1000000
            ]
        ]);
        $builder->add('is_integer', '整数使用', 'switch', State::NO['value'], [
            'required' => true,
            'where' => [
                ['channels', '=', PaymentChannels::INTEGRAL['value']]
            ],
            'prompt' => [
                $Component->add('text', ['default' => '开启后只能使用整数的倍数积分'], ['type' => 'info', 'size' => 'small'])
                    ->builder()
            ],
            'props' => [
                'active-value' => State::YES['value'],
                'inactive-value' => State::NO['value']
            ]
        ]);
        $builder->add('integer', '整数', 'input-number', null, [
            'required' => true,
            'where' => [
                ['channels', '=', PaymentChannels::INTEGRAL['value']],
                ['is_integer', '=', State::YES['value']]
            ],
            'prompt' => [
                $Component->add('text', ['default' => '整数的倍数使用'], ['type' => 'info', 'size' => 'small'])
                    ->builder()
            ],
            'props' => [
                'controls' => false,
                'min' => 1,
                'max' => 1000000
            ]
        ]);
        $builder->add('notify_url', '支付通知', 'input', null, [
            'required' => true,
            'where' => [
                ['channels', 'in', [PaymentChannels::WXPAY['value'],PaymentChannels::ALIPAY['value']]]
            ],
            'prompt' => [
                $Component->add('text', ['default' => '只需要填写域名，不需要填写路径，如：https://www.baidu.com'], ['type' => 'info', 'size' => 'small'])
                    ->builder()
            ],
            'props' => [
                'type' => 'text',
                'placeholder' => '支付通知接口域名'
            ]
        ]);
        return $builder;
    }
}
