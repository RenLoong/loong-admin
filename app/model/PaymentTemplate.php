<?php

namespace app\model;

use app\expose\enum\PaymentChannels;
use app\expose\enum\State;

class PaymentTemplate extends Basic
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
    public static function options($channels = null)
    {
        $options = [];
        $where = [];
        $where[] = ['state', '=', State::YES['value']];
        if ($channels) {
            $where[] = ['channels', '=', $channels];
        }
        $templates = self::where($where)->select();
        foreach ($templates as $template) {
            $channel = PaymentChannels::getText($template->channels);
            $options[] = [
                'label' => "{$channel} - {$template->title}",
                'value' => $template->id,
                'extra' => [
                    'where' => [
                        ['channels', '=', $template->channels]
                    ]
                ],
            ];
        }
        return $options;
    }
}
