<?php

namespace app\expose\build\builder\dataBuilder\component;

use app\expose\build\builder\dataBuilder\interface\DataBuilderInterface;
use app\expose\build\builder\dataBuilder\Basic;
use app\expose\utils\Str;

/**
 * 统计组件
 * 
 * 使用set+属性名的方式设置属性，如setLabel、setTips、setUnit等
 * 
 * @method statistic setLabel(string $label) 设置标签
 * @method statistic setTips(string $tips) 设置提示
 * @method statistic setUnit(string $unit) 设置单位
 * @method statistic setClass(string $class) 设置class属性
 * @method statistic setInterval(int $interval) 自动更新数据的时间间隔
 */
class statistic extends Basic implements DataBuilderInterface
{
    protected $data = [];
    public function __construct()
    {
        $this->data['name'] = 'statistic';
        $this->data['props'] = [];
    }
    public function __call($name, $arguments)
    {
        $name = lcfirst(str_replace('set', '', $name));
        $name = Str::snake($name, '-');
        $this->data['props'][$name] = $arguments[0];
        return $this;
    }
    /**
     * 设置数据
     *
     * @param mixed $data
     * @param number $data.today 今日数据
     * @param number $data.yesterday 昨日数据
     * @param number $data.growth_rate 增长率
     * @return statistic
     */
    public function setData(mixed $data): statistic
    {
        $this->data['props']['data'] = $data;
        return $this;
    }
    public function setApi(string $api): statistic
    {
        $this->data['props']['api'] = $api;
        return $this;
    }
}
