<?php

namespace app\expose\trait;

use app\expose\helper\Config as HelperConfig;
use app\model\Config as ModelConfig;
use app\expose\enum\ResponseEvent;
use app\expose\helper\ConfigGroup;

/**
 * 使用该抽象类需要在控制器中引入以下代码
 * 
 * use app\expose\trait\Config;
 * use app\expose\utils\Json;
 * 
 * Class Config
 * {
 *    use Config;
 *    use Json;
 * }
 */
trait Config
{
    /**
     * 配置管理
     * @return mixed
     */
    private function builder($callback = null)
    {
        $request = request();
        if ($request->method() === 'POST') {
            return $this->update($callback);
        }
        $builder = HelperConfig::formBuilder($request->action);
        return $this->resData($builder);
    }
    private function tabsBuilder($callback = null)
    {
        $request = request();
        if ($request->method() === 'POST') {
            return $this->update($callback);
        }
        $builder = ConfigGroup::formBuilder($request->action);
        return $this->resData($builder);
    }
    private function update($callback = null)
    {
        $request = request();
        $HelperConfig = new HelperConfig($request->action);
        $group = $HelperConfig->getGrop();
        $D = $request->post();
        $ConfigModel = ModelConfig::where(['group' => $group])->find();
        if (!$ConfigModel) {
            $ConfigModel = new ModelConfig;
            $ConfigModel->group = $group;
        }
        $ConfigModel->value = $D;
        if ($ConfigModel->save()) {
            if ($callback) {
                $callback($D);
            }
            return $this->event(ResponseEvent::UPDATE_WEBCONFIG, '保存成功');
        }
        return $this->fail('保存失败');
    }
}
