<?php

namespace app\middleware;

use Webman\MiddlewareInterface;
use Webman\Http\Response;
use Webman\Http\Request;

class Access implements MiddlewareInterface
{
    public function process(Request $request, callable $next): Response
    {
        // $response = $next($request);
        // $response->withHeader('Access-Control-Allow-Origin', '*');
        // $response->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        // $response->withHeader('Access-Control-Allow-Headers', 'x-requested-with, Content-Type, Accept, Origin, Authorization');
        // $response->withHeader('Access-Control-Allow-Credentials', 'true');
        // return $response;
        $response = $next($request);
        if (config('app.debug')) {
            $response->withHeader('Access-Control-Allow-Origin', '*');
            $response->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
            $response->withHeader('Access-Control-Allow-Headers', 'x-requested-with, Content-Type, Accept, Origin, Authorization');
            $response->withHeader('Access-Control-Allow-Credentials', 'true');
        }
        return $response;
    }
}
