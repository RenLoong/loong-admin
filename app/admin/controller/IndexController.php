<?php

namespace app\admin\controller;

use app\Basic;
use app\expose\build\builder\DataboardBuilder;
use app\expose\build\builder\databoardBuilder\component\Echarts;
use app\expose\build\builder\databoardBuilder\component\Statistic;
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
        $statistic = new Statistic;
        $statistic->setLabel('今日新注册用户')
            ->setUnit('人')
            ->setData([
                'today' => 100,
                'yesterday' => 50,
                'growth_rate' => 0.5
            ])
            ->setClass('p-6');
        $builder->add($statistic, [
            'xs' => 24,
            'sm' => 12,
            'md' => 8,
            'lg' => 6,
            'xl' => 4,
            'class' => 'bg-white p-4 rounded-4 shadow-lighter'
        ]);
        $statistic = new Statistic;
        $statistic->setLabel('今日成交订单额')
            ->setUnit('元')
            ->setData([
                'today' => 100,
                'yesterday' => 50,
                'growth_rate' => 0.5
            ])
            ->setClass('p-6');
        $builder->add($statistic, [
            'xs' => 24,
            'sm' => 12,
            'md' => 8,
            'lg' => 6,
            'xl' => 4,
            'class' => 'bg-white p-4 rounded-4 shadow-lighter'
        ]);
        $statistic = new Statistic;
        $statistic->setLabel('今日成交订单量')
            ->setUnit('单')
            ->setData([
                'today' => 100,
                'yesterday' => 50,
                'growth_rate' => 0.5
            ])
            ->setClass('p-6');
        $builder->add($statistic, [
            'xs' => 24,
            'sm' => 12,
            'md' => 8,
            'lg' => 6,
            'xl' => 4,
            'class' => 'bg-white p-4 rounded-4 shadow-lighter'
        ]);
        $echarts = new Echarts;
        $echarts->setClass('bg-white p-4 rounded-4 shadow-lighter vh-70');
        $echarts->setData($this->getEchartsData($request));
        // $echarts->setApi('/admin/index/getEcharts');
        // $echarts->setInterval(3000);
        $builder->add($echarts);
        return $this->resData($builder);
    }
    public function getEcharts(Request $request)
    {
        return $this->resData([
            'series' => [
                [
                    'name' => '邮件营销',
                    'type' => 'line',
                    'smooth' => true,
                    'data' => [ 101, 134, 90, 230, 210, 220,500]
                ],
                /* [
                    'name' => '联盟广告',
                    'type' => 'line',
                    'smooth' => true,
                    'data' => [132, 101, 134, 90, 230, 210, 300]
                ],
                [
                    'name' => '视频广告',
                    'type' => 'line',
                    'smooth' => true,
                    'data' => [132, 101, 134, 90, 230, 210, 530]
                ],
                [
                    'name' => '直接访问',
                    'type' => 'line',
                    'smooth' => true,
                    'data' => [132, 101, 134, 90, 230, 210, 102]
                ],
                [
                    'name' => '搜索引擎',
                    'type' => 'line',
                    'smooth' => true,
                    'data' => [132, 101, 134, 90, 230, 210, 466]
                ] */
            ]
        ]);
    }
    public function getEchartsData(Request $request)
    {
        return [
            'color' => ['#80FFA5', '#00DDFF', '#37A2FF', '#FF0087', '#FFBF00'],
            'title' => [
                'text' => '数据可视化'
            ],
            'tooltip' => [
                'trigger' => 'axis',
                'axisPointer' => [
                    'type' => 'cross',
                    'label' => [
                        'backgroundColor' => '#6a7985'
                    ]
                ]
            ],
            'legend' => [
                'data' => ['邮件营销', '联盟广告', '视频广告', '直接访问', '搜索引擎']
            ],
            'toolbox' => [
                'show' => false
            ],
            'grid' => [
                'left' => '3%',
                'right' => '4%',
                'bottom' => '3%',
                'containLabel' => true
            ],
            'xAxis' => [
                [
                    'type' => 'category',
                    'boundaryGap' => false,
                    'data' => ['周一', '周二', '周三', '周四', '周五', '周六', '周日']
                ]
            ],
            'yAxis' => [
                [
                    'type' => 'value'
                ]
            ],
            'series' => [
                [
                    'name' => '邮件营销',
                    'type' => 'line',
                    'smooth' => true,
                    'data' => [120, 132, 101, 134, 90, 230, 210]
                ],
                /* [
                    'name' => '联盟广告',
                    'type' => 'line',
                    'smooth' => true,
                    'data' => [120, 132, 101, 134, 90, 230, 210]
                ],
                [
                    'name' => '视频广告',
                    'type' => 'line',
                    'smooth' => true,
                    'data' => [120, 132, 101, 134, 90, 230, 210]
                ],
                [
                    'name' => '直接访问',
                    'type' => 'line',
                    'smooth' => true,
                    'data' => [120, 132, 101, 134, 90, 230, 210]
                ],
                [
                    'name' => '搜索引擎',
                    'type' => 'line',
                    'smooth' => true,
                    'data' => [120, 132, 101, 134, 90, 230, 210]
                ] */
            ]
        ];
    }
}
