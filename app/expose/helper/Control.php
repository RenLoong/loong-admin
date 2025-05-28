<?php

namespace app\expose\helper;

class Control extends Menus
{
    /**
     * 构造函数
     *
     * @param object $Install 需实现 getMenus 方法的类返回菜单数据
     */
    public function __construct($Install)
    {
        $data = $Install->getMenus();
        foreach (glob(base_path('plugin/*')) as $path) {
            $plugin_name = basename($path);
            $class = 'plugin\\' . $plugin_name . '\\api\\Control';
            if (!class_exists($class)) {
                continue;
            }
            $plugin = new $class;
            $menus = $plugin->getMenus();
            if ($menus) {
                $data[] = $menus;
            }
        }
        $this->builder($data);
    }
}
