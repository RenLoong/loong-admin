<?php

namespace app\model;

class Config extends Basic
{
    protected function getOptions(): array
    {
        return [
            'type' => [
                // 设置JSON字段的类型
                'value'	=>	'json'
            ]
        ];
    }
}
