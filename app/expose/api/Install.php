<?php

namespace app\expose\api;

trait Install
{
    protected $path;
    /**
     * 安装
     *
     * @param $version
     * @return void
     */
    public static function install($version)
    {
    }

    /**
     * 卸载
     *
     * @param $version
     * @return void
     */
    public static function uninstall($version)
    {
    }

    /**
     * 更新
     *
     * @param $from_version
     * @param $to_version
     * @param $context
     * @return void
     */
    public static function update($from_version, $to_version, $context = null)
    {
    }

    /**
     * 更新前数据收集等
     *
     * @param $from_version
     * @param $to_version
     * @return array|array[]
     */
    public static function beforeUpdate($from_version, $to_version)
    {
        // 在更新之前获得老菜单，通过context传递给 update
        return [];
    }

    /**
     * 获取菜单
     *
     * @return array|mixed
     */
    public function getMenus()
    {
        clearstatcache();
        # 当前类的运行目录
        if (is_file($menu_file = $this->path . '/../menu.json')) {
            return json_decode(file_get_contents($menu_file), true);
        }
        return [];
    }
}
