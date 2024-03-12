<?php

namespace app\expose\build\builder;

class SoltBuilder
{
    public $name = 'default';
    public function __construct($name = 'default')
    {
        $this->name = $name;
    }
    public static function solt(string $solt = 'default')
    {
        $self = new self($solt);
        return $self;
    }
    public function text(string $text)
    {
        return [$this->name => $text];
    }
    public function add(mixed $component, mixed $props = [], mixed $children = null)
    {
        return [
            $this->name => [
                'component' => $component,
                'props' => $props,
                'children' => $children
            ]
        ];
    }
}
