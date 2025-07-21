<?php

namespace app\expose\enum;

use app\expose\enum\builder\Enum;

class PaymentChannels extends Enum
{
    const WXPAY = [
        'label' => '微信支付',
        'value' => 'wxpay',
        'icon' => '/static/image/wxpay.png',
        'props' => [
            'type' => 'success'
        ]
    ];
    const ALIPAY = [
        'label' => '支付宝支付',
        'value' => 'alipay',
        'icon' => '/static/image/alipay.png',
        'props' => [
            'type' => 'primary'
        ]
    ];
    const BALANCE = [
        'label' => '余额支付',
        'value' => 'balance',
        'icon' => '/static/image/balance.png',
        'props' => [
            'type' => 'info'
        ]
    ];
    const INTEGRAL = [
        'label' => '积分支付',
        'value' => 'integral',
        'icon' => '/static/image/integral.png',
        'props' => [
            'type' => 'warning'
        ]
    ];
    const CASH = [
        'label' => '现金支付',
        'value' => 'cash',
        'icon' => '/static/image/cash.png',
        'props' => [
            'type' => 'danger'
        ]
    ];
    const COUPON = [
        'label' => '优惠券支付',
        'value' => 'coupon',
        'icon' => '/static/image/coupon.png',
        'props' => [
            'type' => 'info'
        ]
    ];
    const ADMIN = [
        'label' => '管理员操作',
        'value' => 'admin',
        'icon' => '/static/image/admin.png',
        'props' => [
            'type' => 'warning'
        ]
    ];
}
