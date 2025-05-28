<?php

namespace app\expose\build\builder;

use app\expose\build\builder\databoardBuilder\Basic;
use app\expose\utils\DataModel;

class DataboardBuilder extends DataModel
{
    protected $data = [];
    public function __construct($props = [])
    {
        $this->data['props'] = array_merge([
            'gutter' => 0
        ], $props);
        $this->data['rows'] = [];
    }
    public function add(Basic $component, array $props = [], array $row = [])
    {
        $this->data['rows'][] = [
            'props' => $props,
            'row' => $row,
            'component' => $component
        ];
        return $this;
    }
}
