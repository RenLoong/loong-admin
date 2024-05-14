<?php

namespace app\control\controller;

use app\Basic;
use app\expose\build\builder\DataboardBuilder;
use support\Request;

class IndexController extends Basic
{
    /**
     * 不需要登录的方法
     * @var string[]
     */
    protected $notNeedLogin = ['index'];
    protected $notNeedAuth = ['index'];
    public function index(Request $request)
    {
        $path = $request->path();
        # 如果不是以/结尾的，就重定向到以/结尾的URL
        if (substr($path, -1) != '/') {
            return redirect($path . '/');
        }
        return view(public_path('index.html'));
    }
    public function control(Request $request)
    {
        $builder = new DataboardBuilder([
            'gutter' => 6
        ]);
        $pluginConfig = glob(base_path("plugin/*/api/{$request->app}/IndexController.php"));
        foreach ($pluginConfig as $path) {
            $plugin_name = basename(dirname(dirname(dirname($path))));
            $class = 'plugin\\' . $plugin_name . "\\api\\{$request->app}\\IndexController";
            if (!class_exists($class)) {
                continue;
            }
            $plugin = new $class;
            if (method_exists($plugin, 'control')) {
                $plugin->control($builder);
            }
        }
        return $this->resData($builder);
    }
}
