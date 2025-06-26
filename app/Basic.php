<?php

namespace app;

use app\expose\utils\Json;
use support\Request;

class Basic
{
    protected $model;
    use Json;
    /**
     * 更新指定字段
     * @method POST
     */
    public function indexUpdateField(Request $request)
    {
        $id = $request->post('id');
        $field = $request->post('field');
        $value = $request->post('value');
        $model = $this->model->where(['id' => $id])->find();
        if (!$model) {
            return $this->fail('数据不存在');
        }
        $model->{$field} = $value;
        if ($model->save()) {
            return $this->success();
        }
        return $this->fail('操作失败');
    }
    /**
     * 更新状态字段
     * @method POST
     */
    public function indexUpdateState(Request $request)
    {
        $id = $request->post('id');
        $field = $request->post('field');
        $value = $request->post('value');
        $model = $this->model->where(['id' => $id])->find();
        if (!$model) {
            return $this->fail('数据不存在');
        }
        $model->{$field} = $value;
        if ($model->save()) {
            return $this->success();
        }
        return $this->fail('操作失败');
    }
}
