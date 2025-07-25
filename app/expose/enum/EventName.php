<?php

namespace app\expose\enum;

use app\expose\enum\builder\Enum;

class EventName extends Enum
{
    const USER_REGISTER = [
        'label' => '注册',
        'value' => 'USER.REGISTER',
        'props' => [
            'type' => 'primary'
        ]
    ];
    const USER_LOGIN = [
        'label' => '登录',
        'value' => 'USER.LOGIN',
        'props' => [
            'type' => 'success'
        ]
    ];
    const USER_LOGOUT = [
        'label' => '退出',
        'value' => 'USER.LOGOUT',
        'props' => [
            'type' => 'warning'
        ]
    ];
    const  USER_UPDATE = [
        'label' => '更新用户信息',
        'value' => 'USER.UPDATE',
        'props' => [
            'type' => 'info'
        ]
    ];
    const ORDERS_CREATE = [
        'label' => '创建订单',
        'value' => 'ORDERS.CREATE',
        'props' => [
            'type' => 'info'
        ]
    ];
    const ORDERS_PAY = [
        'label' => '支付订单',
        'value' => 'ORDERS.PAY',
        'props' => [
            'type' => 'danger'
        ]
    ];
    const ORDERS_PAY_SUCCESS = [
        'label' => '支付成功',
        'value' => 'ORDERS.PAY_SUCCESS',
        'props' => [
            'type' => 'success'
        ]
    ];
    const ORDERS_CANCEL = [
        'label' => '取消订单',
        'value' => 'ORDERS.CANCEL',
        'props' => [
            'type' => 'info'
        ]
    ];
    const ORDERS_REFUND = [
        'label' => '退款订单',
        'value' => 'ORDERS.REFUND',
        'props' => [
            'type' => 'warning'
        ]
    ];
    const ORDERS_FINISH = [
        'label' => '完成订单',
        'value' => 'ORDERS.FINISH',
        'props' => [
            'type' => 'success'
        ]
    ];
    const WECHAT_OFFICIAL_ACCOUNT_SCAN = [
        'label' => '微信公众号扫码',
        'value' => 'WECHAT_OFFICIAL_ACCOUNT.SCAN',
        'props' => [
            'type' => 'primary'
        ]
    ];
    const WECHAT_OFFICIAL_ACCOUNT_SUBSCRLBE=[
        'label' => '微信公众号关注',
        'value' => 'WECHAT_OFFICIAL_ACCOUNT.SUBSCRLBE',
        'props' => [
            'type' => 'primary'
        ]
    ];
    const WECHAT_OFFICIAL_ACCOUNT_UNSUBSCRLBE=[
        'label' => '微信公众号取关',
        'value' => 'WECHAT_OFFICIAL_ACCOUNT.UNSUBSCRLBE',
        'props' => [
            'type' => 'primary'
        ]
    ];
    const NOTIFICATION_LIMIT= [
        'label' => '有限通知',
        'value' => 'NOTIFICATION.LIMIT',
        'props' => [
            'type' => 'info'
        ]
    ];
    const NOTIFICATION_UNLIMIT= [
        'label' => '无限通知',
        'value' => 'NOTIFICATION.UNLIMIT',
        'props' => [
            'type' => 'info'
        ]
    ];
}
