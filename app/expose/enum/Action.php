<?php

namespace app\expose\enum;

use app\expose\enum\builder\Enum;

class Action extends Enum
{
    const DEFAULT = [
        'label' => '页面跳转',
        'value' => ''
    ];
    const REDIRECT = [
        'label' => '重定向',
        'value' => 'redirect'
    ];
    const COMFIRM = [
        'label' => '确认操作',
        'value' => 'comfirm'
    ];
    const DIALOG = [
        'label' => '弹窗操作',
        'value' => 'dialog'
    ];
    const LOCK = [
        'label' => '锁屏',
        'value' => 'Lock'
    ];
    const SEARCH = [
        'label' => '搜索',
        'value' => 'Search'
    ];
    const NOTIFICATION = [
        'label' => '通知',
        'value' => 'Notification'
    ];
    const FULL_SCREEN = [
        'label' => '全屏',
        'value' => 'FullScreen'
    ];
    const OUT_LOGIN = [
        'label' => '退出登录',
        'value' => 'OutLogin'
    ];
}
