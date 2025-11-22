<?php

namespace app\expose\build\builder;

use app\expose\utils\DataModel;

/**
 * 信息展示构建器
 * 
 * @package app\expose\build\builder
 * @property string $formName 信息展示名
 * @property string $formTitle 信息展示标题
 * @property array $props Form Attributes
 * @method InfoBuilder add(string $field, string $title, string $component, mixed $extra = [],?ActionBuilder $action = null) 向信息展示中添加字段
 * @method InfoBuilder remove(string $field) 从信息展示中移除字段
 * @method InfoBuilder addValue(string $field, mixed $value) 向信息展示中添加数据
 * @method InfoBuilder setData(array $data) 设置信息展示数据
 * @method InfoBuilder addGroupInfo(InfoBuilder $builder) 向信息展示中添加分组
 */
class InfoBuilder extends DataModel
{
    protected $data = [];
    protected $translations = false;
    public function __construct($formName = null, $formTitle = null, $props = [])
    {
        if (isset($props['translations'])) {
            $this->translations = $props['translations'];
            unset($props['translations']);
        }
        $this->data['props'] = $props;
        $this->data['name'] = $formName ?? 'basic';
        $this->data['title'] = $this->trans($formTitle) ?? $this->trans('form_basic_title');
        $this->data['rule'] = [];
        $this->data['group'] = [];
        $this->data['data'] = [];
    }
    public function setTranslations(bool $state = true)
    {
        $this->translations = $state;
        return $this;
    }
    /**
     * 向信息展示中添加字段
     *
     * @param string $field 字段名
     * @param string $title 字段标题
     * @param string $component 组件名，ElementUI不含"el-"前缀组件名，例如: input，自定义组件：bundle：附件库
     * @param mixed $extra 额外参数
     * @param mixed $extra.options 子选项数据, 例如: [['label' => '选项1', 'value' => 1], ['label' => '选项2', 'value' => 2]]
     * @param mixed $extra.props 组件属性, 例如: ['placeholder' => '请输入内容']
     * @param mixed $extra.subProps 子组件选项属性，和$extra.props类似
     * @param mixed $extra.children 插槽内容，['default' => '内容']或['default' => ComponentBuilder ]
     * @param mixed $extra.prompt 提示信息, 详见 \app\expose\build\builder\ComponentBuilder
     * @param ActionBuilder|null $action 操作按钮, 详见 \app\expose\build\builder\ActionBuilder
     * @return InfoBuilder
     */
    public function add(string $field, string $title, string $component, mixed $extra = [], ?ActionBuilder $action = null): InfoBuilder
    {
        $title = $this->trans($title);
        $this->data['rule'][] = [
            'field'         => $field,
            'title'         => $title,
            'component'     => $component,
            'extra'         => $extra,
            'action'        => $action ? $action->builder() : null
        ];
        return $this;
    }
    /**
     * 从信息展示中移除字段
     *
     * @param string $field 字段名
     * @return InfoBuilder
     */
    public function remove(string $field): InfoBuilder
    {
        $rule = array_filter($this->data['rule'], function ($item) use ($field) {
            return $item['field'] != $field;
        });
        $this->data['rule'] = array_values($rule);
        return $this;
    }
    /**
     * 向表单中添加数据
     *
     * @param string $field 字段名
     * @param mixed $value 默认值
     * @return InfoBuilder
     */
    public function addValue(string $field, mixed $value): InfoBuilder
    {
        $this->data['data'][$field] = $value;
        return $this;
    }
    /**
     * 设置表单数据
     *
     * @param array $data 数据
     * @return InfoBuilder
     */
    public function setData(array $data): InfoBuilder
    {
        foreach ($data as $key => $value) {
            $this->addValue($key, $value);
        }
        return $this;
    }
    /**
     * 获取表单名
     *
     * @return string
     */
    public function getInfoName(): string
    {
        return $this->data['name'];
    }
    /**
     * 获取表单标题
     *
     * @return string
     */
    public function getInfoTitle(): string
    {
        return $this->data['title'];
    }
    /**
     * 向表单中添加分组
     *
     * @param InfoBuilder $builder 分组表单
     * @return InfoBuilder
     */
    public function addGroupInfo(InfoBuilder $builder): InfoBuilder
    {
        $infoName = $builder->getInfoName();
        $temp = $builder->toArray();
        $this->data['group'][] = $temp;
        $this->addValue($infoName, $temp['data']);
        return $this;
    }
    public function trans(string|null $val, array $parameters = [])
    {
        if (!$val || !$this->translations) {
            return $val;
        }
        $request = request();
        $lang = '';
        $domain = null;
        if ($request && $request->lang) {
            $lang = $request->lang;
            $domain = $request->app;
        }
        return trans($val, $parameters, $domain, $lang);
    }
}
