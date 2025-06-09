<?php

use app\expose\build\builder\ComponentBuilder;
use app\expose\enum\SmsChannels;

$Component = new ComponentBuilder;
return [
    [
        'title' => '服务商',
        'field' => 'channels',
        'value' => 'aliyun',
        'component' => 'radio',
        'extra' => [
            'required' => true,
            'prompt' => [
                $Component->add('text', ['default' => '默认使用短信服务商'], ['type' => 'info', 'size' => 'small'])
                    ->builder()
            ],
            'options' => SmsChannels::getOptions(),
            'subProps' => [
                'border' => 1
            ]
        ]
    ],
    'group' => [
        [

            'title' => SmsChannels::ALIYUN['label'],
            'name' => SmsChannels::ALIYUN['value'],
            'children' => [
                [
                    'title' => '开关',
                    'field' => 'enable',
                    'value' => false,
                    'component' => 'switch',
                    'extra' => [
                        'prompt' => [
                            $Component->add('text', ['default' => '是否启用阿里云短信服务'], ['type' => 'info', 'size' => 'small'])
                                ->builder()
                        ]
                    ]
                ],
                [
                    'title' => 'AccessKey ID',
                    'field' => 'access_key_id',
                    'value' => '',
                    'component' => 'input',
                    'extra' => [
                        'required' => true,
                        'where' => [
                            ['enable', '=', true]
                        ],
                        'prompt' => [
                            $Component->add('text', ['default' => '阿里云-AccessKey管理-AccessKey ID，'], ['type' => 'info', 'size' => 'small'])
                                ->add('link', ['default' => '阿里云AccessKey'], ['target' => '_blank', 'href' => 'https://ram.console.aliyun.com/manage/ak', 'type' => 'info', 'underline' => 'never', 'size' => 'small'])
                                ->builder()
                        ]
                    ]
                ],
                [
                    'title' => 'AccessKey Secret',
                    'field' => 'access_secret',
                    'value' => '',
                    'component' => 'input',
                    'extra' => [
                        'required' => true,
                        'where' => [
                            ['enable', '=', true]
                        ],
                        'prompt' => [
                            $Component->add('text', ['default' => '阿里云-AccessKey管理-AccessKey Secret'], ['type' => 'info', 'size' => 'small'])
                                ->builder()
                        ]
                    ]
                ],
                [
                    'title' => '短信签名',
                    'field' => 'sign_name',
                    'value' => '',
                    'component' => 'input',
                    'extra' => [
                        'required' => true,
                        'where' => [
                            ['enable', '=', true]
                        ],
                        'prompt' => [
                            $Component->add('text', ['default' => '阿里云-短信服务-国内消息-签名管理，'], ['type' => 'info', 'size' => 'small'])
                                ->add('link', ['default' => '阿里云短信签名'], ['target' => '_blank', 'href' => 'https://dysms.console.aliyun.com/domestic/text', 'type' => 'info', 'underline' => 'never', 'size' => 'small'])
                                ->builder()
                        ]
                    ]
                ],
                [
                    'title' => '验证码短信模板',
                    'field' => 'vcode_template_code',
                    'value' => '',
                    'component' => 'input',
                    'extra' => [
                        'required' => true,
                        'where' => [
                            ['enable', '=', true]
                        ],
                        'prompt' => [
                            $Component->add('text', ['default' => '阿里云-短信服务-国内消息-模板管理，'], ['type' => 'info', 'size' => 'small'])
                                ->add('link', ['default' => '阿里云短信模板'], ['target' => '_blank', 'href' => 'https://dysms.console.aliyun.com/domestic/text/template', 'type' => 'info', 'underline' => 'never', 'size' => 'small'])
                                ->builder()
                        ]
                    ]
                ],
            ]
        ],
        [
            "title" => SmsChannels::TENCENT['label'],
            "name" => SmsChannels::TENCENT['value'],
            "children" => [
                [
                    'title' => '开关',
                    'field' => 'enable',
                    'value' => false,
                    'component' => 'switch',
                    'extra' => [
                        'prompt' => [
                            $Component->add('text', ['default' => '是否启用腾讯云短信服务'], ['type' => 'info', 'size' => 'small'])
                                ->builder()
                        ]
                    ]
                ],
                [
                    "title" => "SecretId",
                    "field" => "secret_id",
                    "value" => "",
                    "component" => "input",
                    "extra" => [
                        "required" => true,
                        'where' => [
                            ['enable', '=', true]
                        ],
                        "prompt" => [
                            $Component->add("text", ["default" => "腾讯云-访问管理-访问密钥-AccessKey ID，"], ["type" => "info", "size" => "small"])
                                ->add("link", ["default" => "腾讯云SecretId"], ["target" => "_blank", "href" => "https://console.cloud.tencent.com/cam/capi", "type" => "info", 'underline' => 'never', "size" => "small"])
                                ->builder()
                        ]
                    ]
                ],
                [
                    "title" => "SecretKey",
                    "field" => "secret_key",
                    "value" => "",
                    "component" => "input",
                    "extra" => [
                        "required" => true,
                        'where' => [
                            ['enable', '=', true]
                        ],
                        "prompt" => [
                            $Component->add("text", ["default" => "腾讯云-访问管理-访问密钥-AccessKey Secret，"], ["type" => "info", "size" => "small"])
                                ->add("link", ["default" => "腾讯云SecretKey"], ["target" => "_blank", "href" => "https://console.cloud.tencent.com/cam/capi", "type" => "info", 'underline' => 'never', "size" => "small"])
                                ->builder()
                        ]
                    ]
                ],
                [
                    "title" => "应用 ID",
                    "field" => "appid",
                    "value" => "",
                    "component" => "input",
                    "extra" => [
                        "required" => true,
                        'where' => [
                            ['enable', '=', true]
                        ],
                        "prompt" => [
                            $Component->add("text", ["default" => "腾讯云-短信-应用管理-应用 ID，"], ["type" => "info", "size" => "small"])
                                ->add("link", ["default" => "腾讯云应用 ID"], ["target" => "_blank", "href" => "https://console.cloud.tencent.com/smsv2/app-manage", "type" => "info", 'underline' => 'never', "size" => "small"])
                                ->builder()
                        ]
                    ]
                ],
                [
                    "title" => "短信签名",
                    "field" => "sign_name",
                    "value" => "",
                    "component" => "input",
                    "extra" => [
                        "required" => true,
                        'where' => [
                            ['enable', '=', true]
                        ],
                        "prompt" => [
                            $Component->add("text", ["default" => "腾讯云-短信-国内短信-签名管理，"], ["type" => "info", "size" => "small"])
                                ->add("link", ["default" => "腾讯云短信签名"], ["target" => "_blank", "href" => "https://console.cloud.tencent.com/smsv2/csms-sign", "type" => "info", 'underline' => 'never', "size" => "small"])
                                ->builder()
                        ]
                    ]
                ],
                [
                    "title" => "验证码短信模板",
                    "field" => "vcode_template_code",
                    "value" => "",
                    "component" => "input",
                    "extra" => [
                        "required" => true,
                        'where' => [
                            ['enable', '=', true]
                        ],
                        "prompt" => [
                            $Component->add("text", ["default" => "腾讯云-短信-国内短信-模板管理，"], ["type" => "info", "size" => "small"])
                                ->add("link", ["default" => "腾讯云短信模板"], ["target" => "_blank", "href" => "https://console.cloud.tencent.com/smsv2/csms-template", "type" => "info", 'underline' => 'never', "size" => "small"])
                                ->builder()
                        ]
                    ]
                ]
            ]
        ]
    ],
];
