<?php

namespace app\expose\middleware;

use Webman\MiddlewareInterface;
use Webman\Http\Response;
use Webman\Http\Request;
use support\View;

/**
 * 如需要使用模板引擎，可以继承此中间件
 */
class Template implements MiddlewareInterface
{
    public function process(Request $request, callable $next): Response
    {
        $webInfo = [
            'title' => 'Webman',
            'keywords' => 'Webman,PHP',
            'description' => 'Webman is a high-performance, component-based PHP framework for web applications.',
        ];
        View::assign('web', $webInfo);
        /** @var Response $response */
        $response = $next($request);
        return $response;
    }
}
