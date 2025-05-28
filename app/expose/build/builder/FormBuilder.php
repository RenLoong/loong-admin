<?php

namespace app\expose\build\builder;

use app\expose\utils\DataModel;

/**
 * 表单构建器
 * 
 * @package app\expose\build\builder
 * @property string $formName 表单名
 * @property string $formTitle 表单标题
 * @property array $rule 规则
 * @property array $form 表单
 * @property array $group 分组
 * @method FormBuilder add(string $field, string $title, string $component, string $value = null, mixed $extra = []) 向表单中添加字段
 * @method FormBuilder remove(string $field) 从表单中移除字段
 * @method FormBuilder addValue(string $field, mixed $value) 向表单中添加数据
 * @method FormBuilder setData(array $data) 设置表单数据
 * @method string getFormName() 获取表单名
 * @method string getFormTitle() 获取表单标题
 * @method FormBuilder addGroupForm(FormBuilder $builder) 向表单中添加分组
 * @method FormBuilder setUrl(string $url) 设置表单提交地址
 */
class FormBuilder extends DataModel
{
    protected $data = [];
    protected $url = '';
    public function __construct($formName = null, $formTitle = null, $props = [])
    {
        $this->data['props'] = $props;
        $this->data['name'] = $formName ?? 'basic';
        $this->data['title'] = $formTitle ?? '基础信息';
        $this->data['rule'] = [];
        $this->data['form'] = [];
        $this->data['group'] = [];
        $this->data['url'] = $this->url;
    }
    /**
     * 向表单中添加字段
     *
     * @param string $field 字段名
     * @param string $title 字段标题
     * @param string $component 组件名，ElementUI不含"el-"前缀组件名，例如: input，自定义组件：bundle：附件库
     * @param mixed|null $value 默认值
     * @param mixed $extra 额外参数
     * @param mixed $extra.options 子选项数据, 例如: [['label' => '选项1', 'value' => 1], ['label' => '选项2', 'value' => 2]]
     * @param mixed $extra.props 组件属性, 例如: ['placeholder' => '请输入内容']
     * @param mixed $extra.subProps 子组件选项属性，和$extra.props类似
     * @param mixed $extra.children 插槽内容，['default' => '内容']或['default' => ComponentBuilder ]
     * @param mixed $extra.prompt 提示信息, 详见 \app\expose\build\builder\ComponentBuilder
     * @return FormBuilder
     */
    public function add(string $field, string $title, string $component, mixed $value = null, mixed $extra = []): FormBuilder
    {
        $this->data['rule'][] = [
            'field'         => $field,
            'title'         => $title,
            'component'     => $component,
            'extra'         => $extra
        ];
        $this->addValue($field, $value);
        return $this;
    }
    /**
     * 从表单中移除字段
     *
     * @param string $field 字段名
     * @return FormBuilder
     */
    public function remove(string $field): FormBuilder
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
     * @return FormBuilder
     */
    public function addValue(string $field, mixed $value): FormBuilder
    {
        $this->data['form'][$field] = $value;
        return $this;
    }
    /**
     * 设置表单数据
     *
     * @param array $data 数据
     * @return FormBuilder
     */
    public function setData(array $data): FormBuilder
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
    public function getFormName(): string
    {
        return $this->data['name'];
    }
    /**
     * 获取表单标题
     *
     * @return string
     */
    public function getFormTitle(): string
    {
        return $this->data['title'];
    }
    /**
     * 向表单中添加分组
     *
     * @param FormBuilder $builder 分组表单
     * @return FormBuilder
     */
    public function addGroupForm(FormBuilder $builder): FormBuilder
    {
        $formName = $builder->getFormName();
        $temp = $builder->toArray();
        $this->data['group'][] = $temp;
        $this->addValue($formName, $temp['form']);
        return $this;
    }
    /**
     * 设置表单提交地址
     *
     * @param string $url 地址
     * @return FormBuilder
     */
    public function setUrl(string $url): FormBuilder
    {
        $this->url = $url;
        $this->data['url'] = $url;
        return $this;
    }
}
