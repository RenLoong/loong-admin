<?php

namespace app\expose\build\builder;

use app\expose\utils\DataModel;

class TableBuilder extends DataModel
{
    protected $data = [];
    public function __construct($props = [])
    {
        $this->data['props'] = array_merge([
            'border' => true,
            'stripe' => true,
            'size' => 'large',
            'header-row-style' => [
                '--el-table-header-bg-color' => 'var(--el-bg-color-page)'
            ]
        ], $props);
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
    public function addSelection(string $prop = '', string $label = '', mixed $extra = [])
    {
        if (!isset($extra['props'])) {
            $extra['props'] = [
                'width' => '50px',
                'type' => 'selection'
            ];
        }
        $extra['props']['type'] = 'selection';
        $this->add($prop, $label, $extra);
        $this->data['selection'] = true;
        return $this;
    }
    public function addAction(string $label, mixed $props = [])
    {
        $this->data['action'] = [
            'label' => $label,
            'extra' => [
                'group' => [],
                'props' => $props,
            ]
        ];
        return $this;
    }
    public function addTableAction(string $label, mixed $extra = [])
    {
        $this->data['action']['extra']['group'][] = [
            'label' => $label,
            'extra' => $extra
        ];
        return $this;
    }
    public function addFooter(mixed $props = [])
    {
        if (!isset($this->data['selection'])) {
            $this->addSelection();
        }
        $this->data['footer'] = [
            'extra' => [
                'group' => [],
                'props' => $props,
            ]
        ];
        return $this;
    }
    public function addFooterAction(string $label, mixed $extra = [])
    {
        $this->data['footer']['extra']['group'][] = [
            'label' => $label,
            'extra' => $extra
        ];
        return $this;
    }
    public function addHeader(mixed $props = [])
    {
        $this->data['header'] = [
            'extra' => [
                'group' => [],
                'props' => $props,
            ]
        ];
        return $this;
    }
    public function addHeaderAction(string $label, mixed $extra = [])
    {
        $this->data['header']['extra']['group'][] = [
            'label' => $label,
            'extra' => $extra
        ];
        return $this;
    }
    public function addScreen(FormBuilder $builder)
    {
        $this->data['screen'] = $builder;
    }
    public function builder()
    {
        return $this->data;
    }
}
