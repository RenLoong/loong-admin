<?php

namespace app\expose\helper;

use app\expose\build\builder\FormBuilder;
use app\expose\enum\SubmitEvent;
use app\model\Config as ModelConfig;
use app\expose\utils\DataModel;

class Config extends DataModel
{
    protected $configData = [];
    protected $groupData = [];
    protected $data = [];
    protected $group = '';
    public function __construct($group, $plugin = null)
    {
        if($plugin===null){
            $request = request();
            $plugin = $request->plugin;
        }
        $this->group = $plugin ? $plugin . '.' . $group : $group;
        $this->configData = config('settings');
        $this->groupData = $this->configData[$this->group] ?? [];
        $this->builder();
    }
    public function builder()
    {
        $d = [];
        if (!empty($this->groupData)) {
            foreach ($this->groupData as $key => $item) {
                $d[$item['field']] = $item['value'];
            }
            $ConfigModel = ModelConfig::where(['group' => $this->group])->find();
            if ($ConfigModel) {
                foreach ($ConfigModel->value as $field => $value) {
                    $d[$field] = $value;
                }
            }
        }
        $this->data = $d;
    }
    public function getGroupData()
    {
        return $this->groupData;
    }
    public function getGrop()
    {
        return $this->group;
    }
    public static function get($group, $field = null, $default = null)
    {
        $self = new self($group);
        if ($field) {
            return isset($self->{$field}) ? $self->{$field} : $default;
        }
        return $self->toArray();
    }
    public static function set($group, $field, $value)
    {
        $self = new self($group);
        $self->{$field} = $value;
        $ConfigModel = ModelConfig::where(['group' => $group])->find();
        if (!$ConfigModel) {
            $ConfigModel = new ModelConfig;
            $ConfigModel->group = $group;
        }
        $ConfigModel->value = $self->toArray();
        $ConfigModel->save();
    }
    public static function formBuilder($group)
    {
        $self = new self($group);
        $builder = new FormBuilder(null, null, [
            'submitEvent' => SubmitEvent::SILENT
        ]);
        $groupData = $self->getGroupData();
        foreach ($groupData as $key => $item) {
            $builder->add($item['field'], $item['title'], $item['component'], $item['value'], $item['extra']);
        }
        $builder->setData($self->toArray());
        return $builder;
    }
}
