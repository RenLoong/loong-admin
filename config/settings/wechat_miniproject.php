<?php

use app\expose\build\builder\ComponentBuilder;

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
                $Component->add('text', ['default' => '是否开启微信小程序'], ['type' => 'info', 'size' => 'small'])
                    ->builder()
            ],
            'props' => []
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
                $Component->add('text', ['default' => '微信小程序AppID(小程序ID)，'], ['type' => 'info', 'size' => 'small'])
                    ->add('link', ['default' => '微信公众平台'], ['href' => 'https://mp.weixin.qq.com/', 'underline' => false, 'target' => '_blank', 'type' => 'primary', 'size' => 'small'])
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
                $Component->add('text', ['default' => '微信小程序AppSecret(小程序密钥)	，'], ['type' => 'info', 'size' => 'small'])
                    ->add('link', ['default' => '微信公众平台'], ['href' => 'https://mp.weixin.qq.com/', 'underline' => false, 'target' => '_blank', 'type' => 'primary', 'size' => 'small'])
                    ->builder()
            ],
            'props' => [
                'placeholder' => '请输入AppSecret'
            ]
        ]
    ],
    [
        'title' => '小程序代码上传密钥',
        'field' => 'code_upload_key',
        'value' => '',
        'component' => 'bundle',
        'extra' => [
            'where' => [
                ['state', '=', true]
            ],
            'prompt' => [
                $Component->add('text', ['default' => '微信小程序代码上传密钥	，'], ['type' => 'info', 'size' => 'small'])
                    ->add('link', ['default' => '微信公众平台'], ['href' => 'https://mp.weixin.qq.com/', 'underline' => false, 'target' => '_blank', 'type' => 'primary', 'size' => 'small'])
                    ->builder()
            ],
            'props' => [
                'view' => 'file'
            ]
        ]
    ],
    [
        'title' => 'request合法域名',
        'field' => 'request_domain',
        'value' => '{DOMAIN}',
        'component' => 'input',
        'extra' => [
            'required' => true,
            'where' => [
                ['state', '=', true]
            ],
            'prompt' => [
                $Component->add('text', ['default' => '微信小程序request合法域名，请将此URL填入：'], ['type' => 'info', 'size' => 'small'])
                    ->add('text', ['default' => '微信小程序-开发-开发管理-服务器域名-配置服务器域名-request合法域名'], ['type' => 'warning', 'size' => 'small'])->builder()
            ],
            'props' => [
                'placeholder' => '请输入request合法域名'
            ]
        ]
    ],
    [
        'title' => 'uploadFile合法域名',
        'field' => 'upload_file_domain',
        'value' => '{DOMAIN}',
        'component' => 'input',
        'extra' => [
            'required' => true,
            'where' => [
                ['state', '=', true]
            ],
            'prompt' => [
                $Component->add('text', ['default' => '微信小程序uploadFile合法域名，请将此URL填入：'], ['type' => 'info', 'size' => 'small'])
                    ->add('text', ['default' => '微信小程序-开发-开发管理-服务器域名-配置服务器域名-uploadFile合法域名'], ['type' => 'warning', 'size' => 'small'])->builder()
            ],
            'props' => [
                'placeholder' => '请输入uploadFile合法域名'
            ]
        ]
    ],
    [
        'title' => 'downloadFile合法域名',
        'field' => 'download_file_domain',
        'value' => '{DOMAIN}',
        'component' => 'input',
        'extra' => [
            'required' => true,
            'where' => [
                ['state', '=', true]
            ],
            'prompt' => [
                $Component->add('text', ['default' => '微信小程序downloadFile合法域名，请将此URL填入：'], ['type' => 'info', 'size' => 'small'])
                    ->add('text', ['default' => '微信小程序-开发-开发管理-服务器域名-配置服务器域名-downloadFile合法域名，'], ['type' => 'warning', 'size' => 'small'])
                    ->add('text', ['default' => '注：如若该域名与本站系统-上传配置-中储存域名不一致时，以上传配置中使用的域名为准'], ['type' => 'danger', 'size' => 'small'])->builder()
            ],
            'props' => [
                'placeholder' => '请输入downloadFile合法域名'
            ]
        ]
    ],
];
