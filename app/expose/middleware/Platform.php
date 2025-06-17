<?php

namespace app\expose\middleware;

use app\expose\enum\Platform as EnumPlatform;
use Webman\MiddlewareInterface;
use Webman\Http\Response;
use Webman\Http\Request;
/**
 * 用到支付必须引用继承这个中间件
 */
class Platform implements MiddlewareInterface
{
    public function process(Request $request, callable $next): Response
    {
        $platform = $request->header('x-platform');
        if ($platform &&EnumPlatform::has($platform)) {
            $request->platform =  $platform;
        }
        $this->isMobile($request);
        if ($request->isMobile) {
            $request->platform = EnumPlatform::H5['value'];
        }
        # 微信浏览器
        $this->isWehcatBrowser($request);
        # 检测多语言
        $this->languare($request);
        $response = $next($request);
        return $response;
    }
    public function isWehcatBrowser($request)
    {
        $request->isWehcatBrowser = strpos(strtolower($request->header('user-agent')??''), 'micromessenger') !== false;
        if($request->isWehcatBrowser&&$request->platform==EnumPlatform::H5['value']){
            $request->platform = EnumPlatform::WECHAT_OFFICIAL_ACCOUNT['value'];
        }
    }
    public function isMobile($request)
    {
        $request->isMobile = strpos(strtolower($request->header('user-agent')??''), 'mobile') !== false;
    }
    public function languare($request)
    {
        $lang=$request->header('lang');
        if(!$lang){
            $AcceptLanguage=$request->header('accept-language');
            if($AcceptLanguage){
                $AcceptLanguageArr=explode(',',$AcceptLanguage);
                if(isset($AcceptLanguageArr[0])){
                    $lang=$AcceptLanguageArr[0];
                }
            }
        }
        $request->lang='zh-CN';
        if($lang){
            $request->lang=$lang;
        }
    }
}
