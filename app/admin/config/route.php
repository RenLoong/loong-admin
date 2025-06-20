<?php

/**
 * 自定义Admin入口
 * @authors 余心(RenLoong)
 * @home https://github.com/RenLoong/loong-admin
 */

use app\expose\utils\Str;
use support\Log;
use Webman\Route;

$admin_path = getenv('SERVER_ADMIN_PATH');
if ($admin_path && $admin_path != 'admin') {
    Route::any('/admin/[{path:.+}]', function () {
        $request = request();
        $error = "ADMIN ROUTE:{$request->getRealIp()} {$request->method()} {$request->host(true)}{$request->uri()}";
        Log::error($error);
        return not_found();
    });
    Route::any('/' . $admin_path . '/[{path:.+}]', function () {
        $args = func_get_args();
        $request = $args[0];
        $pathArr = explode('/', $request->path());
        // Str::title(),转为首字母大写的标题格式
        $controller = Str::title(empty($pathArr[2]) ? 'Index' : $pathArr[2]);
        $action = empty($pathArr[3]) ? 'index' : $pathArr[3];
        $controller = '\\app\\admin\\controller\\' . $controller . 'Controller';
        if (!class_exists($controller)) {
            $error = "ADMIN ROUTE:{$request->getRealIp()} {$request->method()} {$request->host(true)}{$request->uri()}";
            Log::error($error);
            return not_found();
        }
        $request->app = 'admin';
        $request->controller = $controller;
        $request->action = $action;
        $config_middlewares = config('middleware');
        $common_middlewares = isset($config_middlewares['']) ? $config_middlewares[''] : [];
        $admin_middlewares = isset($config_middlewares['admin']) ? $config_middlewares['admin'] : [];
        $middlewares = array_merge($common_middlewares, $admin_middlewares);

        // 最终的控制器处理逻辑（核心 handler）
        $coreHandler = function () use ($controller, $action, $args) {
            return call_user_func_array([new $controller, $action], $args);
        };

        // 构建中间件洋葱圈
        $dispatcher = array_reduce(
            array_reverse($middlewares),
            function ($next, $middleware) {
                return function ($request) use ($middleware, $next) {
                    $middleware = new $middleware;
                    return $middleware->process($request, $next);
                };
            },
            $coreHandler // 最终业务处理
        );

        // 执行并返回响应
        return $dispatcher($request);
    });
}
