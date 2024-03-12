<?php

namespace app\expose\helper;

use Exception;
use support\Response;
use Webman\Captcha\CaptchaBuilder;

/**
 * 图像验证码助手类
 * Class Captcha
 * @package app\helper
 * 
 * @method static Response captcha()
 * @method static array captchaCode()
 * @method static bool checkScode(string $captcha)
 * 
 */
class Captcha
{
    /**
     * 检验图像验证码
     * @param  string  $captcha
     * @return boolean
     */
    public static function checkScode(string $captcha): bool
    {
        $request = request();
        // 对比session中的captcha值
        if (strtolower($captcha) !== $request->session()->get('captcha')) {
            throw new Exception('图像验证码不正确');
        }
        return true;
    }
    public static function create()
    {
        $request = request();
        $bg = $request->get('bg');
        $defaultBg = '255,255,255';
        if ($bg) {
            $defaultBg = $bg;
        }
        // 初始化验证码类
        $builder = new CaptchaBuilder;
        $bgArr = explode(',', $defaultBg);
        $builder->setBackgroundColor($bgArr[0], $bgArr[1], $bgArr[2]);
        $builder->setDistortion(false);
        $builder->setInterpolation(false);
        $builder->setTextColor(255 - $bgArr[0], 255 - $bgArr[1], 255 - $bgArr[2]);
        // 生成验证码
        $builder->build();
        return $builder;
    }

    /**
     * 生成图像验证码
     * @return Response
     */
    public static function captcha(): Response
    {
        $request = request();
        $builder = self::create();
        $request->session()->set('captcha', strtolower($builder->getPhrase()));
        $img_content = $builder->inline();
        return response($img_content, 200);
    }


    /**
     * 图像验证码
     */
    public static function captchaCode(): array
    {
        $request = request();
        $builder = self::create();
        $request->session()->set('captcha', strtolower($builder->getPhrase()));
        $img_content = $builder->inline();
        return ['imag' => $img_content, 'token' => $request->sessionId()];
    }
}
