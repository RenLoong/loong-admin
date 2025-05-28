<?php

namespace app\expose\build\builder;

use app\expose\utils\DataModel;

class AppsBuilder extends DataModel
{
    protected $data = [];
    public function __construct($props = [])
    {
        $this->data['props'] = array_merge([], $props);
        $this->data['columns'] = [];
    }
    public function add(string $prop, string $label, mixed $extra = [])
    {
        $this->data['columns'][] = [
            'prop' => $prop,
            'label' => $label,
            'extra' => $extra
        ];
        return $this;
    }
    public function addAction(string $label, mixed $extra = [])
    {
        $this->data['action'][] = [
            'label' => $label,
            'extra' => $extra
        ];
        return $this;
    }
    public function addTabs(string $label, string $name, mixed $extra)
    {
        $this->data['tabs'][] = [
            'label' => $label,
            'name' => $name,
            'extra' => $extra
        ];
        return $this;
    }
    public function addScreen()
    {
    }
    public function builder()
    {
        return $this->data;
    }
}
