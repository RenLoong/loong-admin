<?php

namespace app\expose\build\builder;

use app\expose\utils\DataModel;

/**
 * 审核表单构建器
 * 
 * @package app\expose\build\builder
 * @property string $formName 审核表单名
 * @property string $formTitle 审核表单标题
 * @property array $props Form Attributes
 * @method ExamineBuilder add(string $field, string $title, string $component, string $value = null, mixed $extra = []) 向审核表单中添加字段
 * @method ExamineBuilder remove(string $field) 从审核表单中移除字段
 * @method ExamineBuilder setOldData(array $data) 设置审核原始对比数据
 * @method ExamineBuilder setNewData(array $data) 设置审核最新对比数据
 * @method FormBuilder addForm(FormBuilder $builder) 添加表单
 */
class ExamineBuilder extends DataModel
{
    protected $data = [];
    protected $translations=false;
    public function __construct( $props = [])
    {
        if(isset($props['translations'])){
            $this->translations=$props['translations'];
            unset($props['translations']);
        }
        $this->data['props'] = $props;
        $this->data['rule'] = [];
        $this->data['form'] = [];
        $this->data['old'] = [];
        $this->data['new'] = [];
    }
    public function setTranslations(bool $state=true){
        $this->translations=$state;
        return $this;
    }
    /**
     * 向审核表单中添加字段
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
     * @return ExamineBuilder
     */
    public function add(string $field, string $title, string $component, mixed $extra = []): ExamineBuilder
    {
        $title = $this->trans($title);
        $this->data['rule'][] = [
            'field'         => $field,
            'title'         => $title,
            'component'     => $component,
            'extra'         => $extra
        ];
        return $this;
    }
    /**
     * 从审核表单中移除字段
     *
     * @param string $field 字段名
     * @return ExamineBuilder
     */
    public function remove(string $field): ExamineBuilder
    {
        $rule = array_filter($this->data['rule'], function ($item) use ($field) {
            return $item['field'] != $field;
        });
        $this->data['rule'] = array_values($rule);
        return $this;
    }
    /**
     * 设置审核原始对比数据
     *
     * @param array $data 数据
     * @return ExamineBuilder
     */
    public function setOldData(array $data): ExamineBuilder
    {
        $this->data['old']=$data;
        return $this;
    }
    /**
     * 设置审核最新对比数据
     *
     * @param array $data 数据
     * @return ExamineBuilder
     */
    public function setNewData(array $data): ExamineBuilder
    {
        $this->data['new']=$data;
        return $this;
    }
    public function addForm(FormBuilder $builder)
    {
        $this->data['form']=$builder;
    }
    public function trans(string|null $val,array $parameters =[])
    {
        if(!$val||!$this->translations){
            return $val;
        }
        $request=request();
        $lang = '';
        $domain=null;
        if ($request && $request->lang) {
            $lang = $request->lang;
            $domain=$request->app;
        }
        return trans($val,$parameters,$domain,$lang);
    }
}
