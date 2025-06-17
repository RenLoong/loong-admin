<?php

use app\expose\build\builder\ComponentBuilder;
use app\expose\build\builder\SoltBuilder;

$Component = new ComponentBuilder;
return [
    [
        'title' => '状态',
        'field' => 'state',
        'value' => 0,
        'component' => 'radio',
        'extra' => [
            'required' => true,
            'prompt' => [
                $Component->add('text', ['default' => '是否开启内置Control'], ['type' => 'info', 'size' => 'small'])
                    ->builder()
            ],
            'options' => [
                ['label' => '关闭', 'value' => 0],
                ['label' => '开启', 'value' => 1]
            ]
        ]
    ],
];