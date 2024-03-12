<?php

namespace app\expose\enum;

use app\expose\enum\builder\Enum;

class Permission extends Enum
{
    const CREATE = [
        'label' => '创建',
        'value' => 'Create'
    ];
    const DELETE = [
        'label' => '删除',
        'value' => 'Delete'
    ];
    const UPDATE = [
        'label' => '更新',
        'value' => 'Update'
    ];
    const UPDATE_STATE = [
        'label' => '更新状态',
        'value' => 'UpdateState'
    ];
}
