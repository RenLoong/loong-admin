<?php

namespace app\expose\api;

trait Control
{
    protected $path;
    /**
     * 获取菜单
     *
     * @return array|mixed
     */
    public function getMenus()
    {
        clearstatcache();
        # 当前类的运行目录
        if (is_file($menu_file = $this->path . '/../control.json')) {
            return json_decode(file_get_contents($menu_file), true);
        }
        return [];
    }
}
