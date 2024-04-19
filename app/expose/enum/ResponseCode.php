<?php

namespace app\expose\enum;

use app\expose\enum\builder\Enum;

/**
 * JSON响应Code静态常量
 * Class ResponseCode
 * @package app\expose\enum
 */
class ResponseCode extends Enum
{
    /**
     * 成功
     */
    const SUCCESS = 200;
    /**
     * 等待
     */
    const WAIT = 202;
    /**
     * 有事件通知
     */
    const SUCCESS_EVENT_PUSH = 201;
    /**
     * 失败
     */
    const FAIL = 404;
    /**
     * 需要登录
     */
    const NEED_LOGIN = 12000;
    /**
     * 验证码错误
     */
    const CAPTCHA = 300;
    /**
     * 站点信息错误
     */
    const SITE_ERROR = 400;
    /**
     * 支付成功
     */
    const PAY_SUCCESS = 9000;
    /**
     * 重定向
     */
    const REDIRECT = 302;
    /**
     * 确认重定向
     */
    const REDIRECT_CONFIRM = 303;
    /**
     * 无权限
     */
    const NO_PERMISSION = 403;
    /**
     * 锁定
     */
    const LOCK = 423;
}
