<?php

namespace app\admin\controller;

use app\Basic;
use app\expose\build\builder\DataboardBuilder;
use app\expose\build\builder\databoardBuilder\component\Statistic;
use app\model\User;
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
        $today=User::whereDay('create_time')->count();
        $yesterday=User::whereDay('create_time','yesterday')->count();
        $statistic = new Statistic;
        $statistic->setLabel('今日新注册用户')
            ->setUnit('人')
            ->setData([
                'today' => $today,
                'yesterday' => $yesterday,
                'growth_rate' => $yesterday?round(($today-$yesterday)/$yesterday*100,2):0
            ])
            ->setClass('p-6');
        $builder->add($statistic, [
            'xs' => 24,
            'sm' => 12,
            'md' => 6,
            'lg' => 4,
            'class' => 'bg-white p-4 rounded-4 shadow-lighter'
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
        foreach ($pluginConfig as $path) {
            $plugin_name = basename(dirname(dirname(dirname($path))));
            $class = 'plugin\\' . $plugin_name . "\\api\\{$request->app}\\IndexController";
            if (!class_exists($class)) {
                continue;
            }
            $plugin = new $class;
            if (method_exists($plugin, 'echarts')) {
                $plugin->echarts($builder);
            }
        }
        return $this->resData($builder);
    }
}
