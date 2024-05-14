<?php

namespace app\expose\build\builder\databoardBuilder\component;

use app\expose\build\builder\databoardBuilder\interface\DataboardBuilderInterface;
use app\expose\build\builder\databoardBuilder\Basic;
use app\expose\utils\Str;
class Placeholder extends Basic implements DataboardBuilderInterface
{
    protected $data = [];
    public function __construct()
    {
        $this->data['name'] = 'div';
        $this->data['props'] = [];
    }
    public function __call($name, $arguments)
    {
        $name = lcfirst(str_replace('set', '', $name));
        $name = Str::snake($name, '_');
        $this->data['props'][$name] = $arguments[0];
        return $this;
    }
    public function setData(mixed $data): Placeholder
    {
        $this->data['props']['data'] = $data;
        return $this;
    }
    public function setApi(string $api): Placeholder
    {
        $this->data['props']['api'] = $api;
        return $this;
    }
}
