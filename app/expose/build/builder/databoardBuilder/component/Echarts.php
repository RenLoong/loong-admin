<?php

namespace app\expose\build\builder\databoardBuilder\component;

use app\expose\build\builder\databoardBuilder\interface\DataboardBuilderInterface;
use app\expose\build\builder\databoardBuilder\Basic;
use app\expose\utils\Str;

class Echarts extends Basic implements DataboardBuilderInterface
{
    protected $data = [];
    public function __construct()
    {
        $this->data['name'] = 'echarts';
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
     * @return echarts
     */
    public function setData(mixed $data): echarts
    {
        $this->data['props']['data'] = $data;
        return $this;
    }
    public function setApi(string $api): echarts
    {
        $this->data['props']['api'] = $api;
        return $this;
    }
}
