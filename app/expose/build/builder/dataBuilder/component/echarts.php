<?php

namespace app\expose\build\builder\dataBuilder\component;

use app\expose\build\builder\dataBuilder\interface\DataBuilderInterface;
use app\expose\build\builder\dataBuilder\Basic;
use app\expose\utils\Str;

class echarts extends Basic implements DataBuilderInterface
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
        $name = Str::snake($name, '-');
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
