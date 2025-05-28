<?php

namespace app\expose\build\config;

use app\expose\utils\DataModel;

class Action extends DataModel
{
    protected $data = [];
    public function __construct(array $data = [])
    {
        $this->data = array_merge($this->data, $data);
    }
    /**
     * 添加一个操作
     *
     * @param string $model 查看 \app\expose\enum\Action::class, 例如 \app\expose\enum\Action::LOCK['value']
     * @param array $props ['icon' => 'Lock','label' => '锁屏']
     * @return Action
     */
    public function add($model, $props = []): Action
    {
        $this->data[] = [
            'model' => $model,
            'props' => $props
        ];
        return $this;
    }
}
