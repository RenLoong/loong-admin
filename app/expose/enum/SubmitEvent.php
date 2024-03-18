<?php

namespace app\expose\enum;

use app\expose\enum\builder\Enum;

/**
 * 表单提交事件
 * 默认提交表单后重置表单
 * @package app\expose\enum
 */
class SubmitEvent extends Enum
{
    /**
     * 提交表单后静默处理
     */
    const SILENT = "SILENT";
}
