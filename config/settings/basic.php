<?php

use app\expose\build\builder\ComponentBuilder;
use app\expose\build\builder\SoltBuilder;

$Component = new ComponentBuilder;
return [
    [
        'title' => 'Settings_basic_web_name',
        'field' => 'web_name',
        'value' => 'RenLoong',
        'component' => 'input',
        'extra' => [
            'required' => true,
            'prompt' => [
                $Component->add('text', ['default' => '应用名称并非网页标题'], ['type' => 'info', 'size' => 'small'])
                    ->builder()
            ],
            'props' => [
                'type' => 'text',
                'placeholder' => '请输入应用名称'
            ]
        ]
    ],
    [
        'title' => '网站标题',
        'field' => 'web_title',
        'value' => 'RenLoong',
        'component' => 'input',
        'extra' => [
            'required' => true,
            'prompt' => [
                $Component->add('text', ['default' => '网页标题，显示于浏览器tab标题'], ['type' => 'info', 'size' => 'small'])
                    ->builder()
            ],
            'props' => [
                'type' => 'text',
                'placeholder' => '请输入网站标题'
            ]
        ]
    ],
    [
        'title' => 'LOGO展示方式',
        'field' => 'logo_use',
        'value' => 'svg',
        'component' => 'radio',
        'extra' => [
            'required' => true,
            'prompt' => [
                $Component->add('text', ['default' => '应用名称将会显示在页面标题中'], ['type' => 'info', 'size' => 'small'])
                    ->builder()
            ],
            'options' => [
                ['label' => '默认', 'value' => 'svg'],
                ['label' => '图片', 'value' => 'image']
            ]
        ]
    ],
    [
        'title' => 'LOGO（浅色）',
        'field' => 'web_logo_light',
        'value' => '',
        'component' => 'bundle',
        'extra' => [
            'where' => [
                ['logo_use', '=', 'image']
            ],
            'prompt' => [
                $Component->add('text', ['default' => '浅色LOGO，用于深色背景'], ['type' => 'info', 'size' => 'small'])
                    ->builder()
            ],
            'props' => [
                'accept' => 'image/*',
                'multiple' => 1
            ]
        ]
    ],
    [
        'title' => 'LOGO（深色）',
        'field' => 'web_logo_dark',
        'value' => '',
        'component' => 'bundle',
        'extra' => [
            'where' => [
                ['logo_use', '=', 'image']
            ],
            'prompt' => [
                $Component->add('text', ['default' => '深色LOGO，用于浅色背景'], ['type' => 'info', 'size' => 'small'])
                    ->builder()
            ],
            'props' => [
                'accept' => 'image/*',
                'multiple' => 1
            ]
        ]
    ],
    [
        'title' => 'ICP备案号',
        'field' => 'web_icp',
        'value' => '',
        'component' => 'input',
        'extra' => [
            'props' => [
                'type' => 'text',
                'placeholder' => '请输入ICP备案号'
            ]
        ]
    ],
    [
        'title' => '公安备案号',
        'field' => 'web_mps',
        'value' => '',
        'component' => 'input',
        'extra' => [
            'prompt' => [
                $Component->add('text', ['default' => '用于跳转至公安备案系统携带的备案号'], ['type' => 'info', 'size' => 'small'])
                    ->builder()
            ],
            'props' => [
                'type' => 'text',
                'placeholder' => '请输入公安备案号'
            ],
            'children' => SoltBuilder::solt('prepend')->add('el-image', ['style' => 'display:flex;', 'src' => '/static/beian.gov.png', 'width' => '15px', 'height' => '15px'])
        ]
    ],
    [
        'title' => '公安备案号文本',
        'field' => 'web_mps_text',
        'value' => '',
        'component' => 'input',
        'extra' => [
            'prompt' => [
                $Component->add('text', ['default' => '展示在网站底部公安备案号'], ['type' => 'info', 'size' => 'small'])
                    ->builder()
            ],
            'props' => [
                'type' => 'text',
                'placeholder' => '请输入公安备案号文本'
            ],
            'children' => SoltBuilder::solt('prepend')->add('el-image', ['style' => 'display:flex;', 'src' => '/static/beian.gov.png', 'width' => '15px', 'height' => '15px'])
        ]
    ],
    [
        'title' => '版权信息',
        'field' => 'copyright',
        'value' => '',
        'component' => 'input',
        'extra' => [
            'props' => [
                'type' => 'text',
                'placeholder' => '请输入版权信息'
            ],
            'children' => SoltBuilder::solt('prepend')->text('©')
        ]
    ],
    [
        'title' => '客服链接',
        'field' => 'wechat_url',
        'value' => '',
        'component' => 'input',
        'extra' => [
            'props' => [
                'type' => 'text',
                'placeholder' => '请输入客服链接链接'
            ]
        ]
    ],
    [
        'title' => '客服二维码',
        'field' => 'wechat_qrcode_url',
        'value' => '',
        'component' => 'bundle',
        'extra' => [
            'props' => [
                'accept' => 'image/*',
                'multiple' => 1
            ]
        ]
    ]
];
