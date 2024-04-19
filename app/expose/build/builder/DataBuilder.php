<?php

namespace app\expose\build\builder;

use app\expose\build\builder\dataBuilder\Basic;
use app\expose\utils\DataModel;

class DataBuilder extends DataModel
{
    protected $data = [];
    public function __construct($props = [])
    {
        $this->data['props'] = array_merge([
            'gutter' => 0
        ], $props);
        $this->data['rows'] = [];
    }
    public function add(Basic $component, array $props = [])
    {
        $this->data['rows'][] = [
            'props' => $props,
            'component' => $component
        ];
        return $this;
    }
}
