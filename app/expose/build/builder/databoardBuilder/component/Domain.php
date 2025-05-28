<?php

namespace app\expose\build\builder\databoardBuilder\component;

use app\expose\build\builder\databoardBuilder\interface\DataboardBuilderInterface;
use app\expose\build\builder\databoardBuilder\Basic;
use app\expose\utils\Str;

/**
 * 申请组件
 * 
 * 使用set+属性名的方式设置属性，如setLabel、setTips、setUnit等
 * 
 * @method Domain setLabel(string $label) 设置标签
 * @method Domain setTips(string $tips) 设置提示
 * @method Domain setClass(string $class) 设置class属性
 * @method Domain setInterval(int $interval) 自动更新数据的时间间隔
 */
class Domain extends Basic implements DataboardBuilderInterface
{
    protected $data = [];
    public function __construct()
    {
        $this->data['name'] = 'domain';
        $this->data['props'] = [];
    }
    public function __call($name, $arguments)
    {
        $name = lcfirst(str_replace('set', '', $name));
        $name = Str::snake($name, '_');
        $this->data['props'][$name] = $arguments[0];
        return $this;
    }
    /**
     * 设置数据
     *
     * @param mixed $data
     * @return Domain
     */
    public function setData(mixed $data): Domain
    {
        $this->data['props']['data'] = $data;
        return $this;
    }
    public function setApi(string $api): Domain
    {
        $this->data['props']['api'] = $api;
        return $this;
    }
}
