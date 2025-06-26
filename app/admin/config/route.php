<?php

/**
 * 自定义Admin入口
 * @authors 余心(RenLoong)
 * @home https://github.com/RenLoong/loong-admin
 */
use Webman\Route;

$admin_path = getenv('SERVER_ADMIN_PATH');
if ($admin_path && $admin_path != 'admin') {
    Route::disableDefaultRoute('', 'admin');
    $controllersClass = glob(app_path('admin') . '/controller/*Controller.php');
    $len = count($controllersClass);
    $routes = [];
    for ($i = 0; $i < $len; $i++) {
        $value = $controllersClass[$i];
        $controllerName = str_replace('Controller', '', basename($value, '.php'));
        $classStr = 'app' . str_replace([app_path(), '.php', '/'], ['', '', '\\'], $value);
        $reflection = new \ReflectionClass('\\'.$classStr);

        // 忽略抽象类、接口
        if ($reflection->isAbstract() || $reflection->isInterface()) {
            continue;
        }

        $actions = $reflection->getMethods(ReflectionMethod::IS_PUBLIC);
        $actionsLen = count($actions);
        for ($n = 0; $n < $actionsLen; $n++) {
            $name = $actions[$n]->name;
            if (!str_starts_with($name, '__')) {
                $routes["/{$controllerName}/{$name}"] = [$classStr, $name];
            }
        }
    }
    $controllersVersionClass = glob(app_path('admin') . '/controller/**/*Controller.php');
    if (!empty($controllersVersionClass)) {
        $len = count($controllersVersionClass);
        for ($i = 0; $i < $len; $i++) {
            $value = $controllersVersionClass[$i];
            $version=basename(dirname($value));
            $controllerName = str_replace('Controller', '', basename($value, '.php'));
            $classStr = 'app' . str_replace([app_path(), '.php', '/'], ['', '', '\\'], $value);
            $reflection = new \ReflectionClass('\\' . $classStr);

            // 忽略抽象类、接口
            if ($reflection->isAbstract() || $reflection->isInterface()) {
                continue;
            }

            $actions = $reflection->getMethods(ReflectionMethod::IS_PUBLIC);
            $actionsLen = count($actions);
            for ($n = 0; $n < $actionsLen; $n++) {
                $name = $actions[$n]->name;

                if (!str_starts_with($name, '__')) {
                    $routes["/{$version}/{$controllerName}/{$name}"] = [$classStr, $name];
                }
            }
        }
    }
    Route::group('/' . $admin_path, function ()use($routes) {
        foreach ($routes as $key => $value) {
            if(in_array($value[1],['indexUpdateField','indexUpdateState'])){
                Route::post($key,$value);
            }else if(strpos($value[1],'GetTable')){
                Route::get($key,$value);
            }else{
                Route::any($key,$value);
            }
        }
    });
}
