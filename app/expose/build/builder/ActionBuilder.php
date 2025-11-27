<?php

namespace app\expose\build\builder;

use app\expose\utils\DataModel;

class ActionBuilder extends DataModel
{
    protected $data = [];
    public function __construct($label = '', $props = [])
    {
        $this->data = [
            'label' => $label,
            'extra' => [
                'group' => [],
                'props' => $props,
            ]
        ];
    }
    /**
     * 向操作按钮中添加字段
     *
     * @param string $label 操作按钮标题
     * @param mixed $extra 额外参数
     * @param string $extra.path 路径, 例如: '/app/pluginExample/admin/Form/index'
     * @param string $extra.model 操作模式, 详见 \app\expose\enum\Action::class，例如：Action::COMFIRM['value']
     * @param mixed $extra.where 显示条件, 例如: [['is_system', '!=', 1]]
     * @param mixed $extra.params 额外传参, 例如: [['id' => 1]]
     * @param string|array $extra.field 指定提交字段, 例如: *或['id'=>'uid']，id：数据集中字段名，uid：提交数据中字段名
     * @param mixed $extra.props 操作属性, 例如: ['type' => 'primary', 'title' => '编辑《{nickname}》']
     * @param mixed $extra.component 操作展示组件
     * @param string $extra.component.name 组件名, 例如: 'button'
     * @param mixed $extra.component.props 组件属性, 例如: ['type' => 'primary', 'size' => 'small']
     * @return ActionBuilder
     */
    public function add(string $label, mixed $extra = [])
    {
        $this->data['extra']['group'][] = [
            'label' => $label,
            'extra' => array_merge([
                'loading' => false,
            ], $extra)
        ];
        return $this;
    }
    /**
     * 设置数据
     *
     * @param array $data 数据
     * @return ActionBuilder
     */
    public function setData(array $data)
    {
        $this->data['data'] = $data;
        return $this;
    }
    /**
     * 设置数据操作
     *
     * @param string $action 操作，append：追加合并数据
     * @return ActionBuilder
     */
    public function setDataAction(string $action)
    {
        $this->data['callback'] = $action;
        return $this;
    }
    public function builder()
    {
        return $this->data;
    }
}
