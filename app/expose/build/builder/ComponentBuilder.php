<?php

namespace app\expose\build\builder;

use app\expose\utils\DataModel;

class ComponentBuilder extends DataModel
{
    protected $data = [];
    public function add(string $component, mixed $children = null, array $props = [])
    {
        $this->data[] = [
            'component' => $component,
            'children' => $children,
            'props' => $props
        ];
        return $this;
    }
    public function builder()
    {
        $result = $this->data;
        $this->data = [];
        return $result;
    }
}
