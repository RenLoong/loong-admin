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
 * @method Apply setLabel(string $label) 设置标签
 * @method Apply setTips(string $tips) 设置提示
 * @method Apply setApply(bool $apply) 设置是否可以申请
 * @method Apply setPrice(int $price) 设置价格
 * @method Apply setAgreement(array $agreement) 设置协议
 * @method Apply setClass(string $class) 设置class属性
 * @method Apply setInterval(int $interval) 自动更新数据的时间间隔
 */
class Apply extends Basic implements DataboardBuilderInterface
{
    protected $data = [];
    public function __construct()
    {
        $this->data['name'] = 'apply';
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
     * @return Apply
     */
    public function setData(mixed $data): Apply
    {
        $this->data['props']['data'] = $data;
        return $this;
    }
    public function setApi(string $api): Apply
    {
        $this->data['props']['api'] = $api;
        return $this;
    }
}
