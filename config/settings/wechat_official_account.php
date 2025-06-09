<?php

use app\expose\build\builder\ComponentBuilder;
use app\expose\utils\Str;

$Component = new ComponentBuilder;
return [
    [
        'title' => '开关',
        'field' => 'state',
        'value' => false,
        'component' => 'switch',
        'extra' => [
            'required' => true,
            'prompt' => [
                $Component->add('text', ['default' => '是否开启微信公众号'], ['type' => 'info', 'size' => 'small'])
                    ->builder()
            ],
            'props' => [
            ]
        ]
    ],
    [
        'title' => 'AppID',
        'field' => 'app_id',
        'value' => '',
        'component' => 'input',
        'extra' => [
            'required' => true,
            'where' => [
                ['state', '=', true]
            ],
            'prompt' => [
                $Component->add('text', ['default' => '微信公众号开发者ID(AppID)，'], ['type' => 'info', 'size' => 'small'])
                    ->add('link', ['default' => '微信公众平台'], ['href' => 'https://mp.weixin.qq.com/', 'underline' => 'never', 'target' => '_blank', 'type' => 'primary', 'size' => 'small'])
                    ->builder()
            ],
            'props' => [
                'placeholder' => '请输入AppID'
            ]
        ]
    ],
    [
        'title' => 'AppSecret',
        'field' => 'app_secret',
        'value' => '',
        'component' => 'input',
        'extra' => [
            'required' => true,
            'where' => [
                ['state', '=', true]
            ],
            'prompt' => [
                $Component->add('text', ['default' => '微信公众号开发者密码(AppSecret)，'], ['type' => 'info', 'size' => 'small'])
                    ->add('link', ['default' => '微信公众平台'], ['href' => 'https://mp.weixin.qq.com/', 'underline' => 'never', 'target' => '_blank', 'type' => 'primary', 'size' => 'small'])
                    ->builder()
            ],
            'props' => [
                'placeholder' => '请输入AppSecret'
            ]
        ]
    ],
    [
        'title' => '接收公众号消息通知状态',
        'field' => 'message_state',
        'value' => false,
        'component' => 'switch',
        'extra' => [
            'required' => true,
            'where' => [
                ['state', '=', true]
            ],
            'prompt' => [
                $Component->add('text', ['default' => '是否开启接收公众号消息通知'], ['type' => 'info', 'size' => 'small'])->builder()
            ],
            'props' => [
            ]
        ]
    ],
    [
        'title' => '服务器地址',
        'field' => 'url',
        'value' => '{DOMAIN}/WechatOfficialAccount/message',
        'component' => 'input',
        'extra' => [
            'required' => true,
            'where' => [
                ['state', '=', true],
                ['message_state', '=', true]
            ],
            'prompt' => [
                $Component->add('text', ['default' => '微信公众号服务器地址(URL)，请将此URL填入：'], ['type' => 'info', 'size' => 'small'])
                    ->add('text', ['default' => '微信公众号-设置与开发-基本配置-服务器配置-服务器地址(URL)'], ['type' => 'warning', 'size' => 'small'])->builder()
            ],
            'props' => [
                'placeholder' => '请输入服务器地址'
            ]
        ]
    ],
    [
        'title' => '令牌',
        'field' => 'token',
        'value' => Str::random(32),
        'component' => 'input',
        'extra' => [
            'required' => true,
            'where' => [
                ['state', '=', true],
                ['message_state', '=', true]
            ],
            'prompt' => [
                $Component->add('text', ['default' => '微信公众号令牌(Token)，请将此Token填入：'], ['type' => 'info', 'size' => 'small'])
                    ->add('text', ['default' => '微信公众号-设置与开发-基本配置-服务器配置-令牌(Token)'], ['type' => 'warning', 'size' => 'small'])
                    ->builder()
            ],
            'props' => [
                'placeholder' => '请输入令牌'
            ]
        ]
    ],
    [
        'title' => '消息加解密密钥',
        'field' => 'aes_key',
        'value' => Str::random(43),
        'component' => 'input',
        'extra' => [
            'required' => true,
            'where' => [
                ['state', '=', true],
                ['message_state', '=', true]
            ],
            'prompt' => [
                $Component->add('text', ['default' => '微信公众号消息加解密密钥(AESKey)，请将此AESKey填入：'], ['type' => 'info', 'size' => 'small'])
                    ->add('text', ['default' => '微信公众号-设置与开发-基本配置-服务器配置-消息加解密方式(AESKey)'], ['type' => 'warning', 'size' => 'small'])
                    ->builder()
            ],
            'props' => [
                'placeholder' => '请输入消息加解密密钥'
            ]
        ]
    ]
];
