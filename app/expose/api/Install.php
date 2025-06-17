<?php

namespace app\expose\api;

use support\Log;

trait Install
{
    protected $path;
    /**
     * 多语言必须在构造函数中设置plugin值为插件名
     */
    protected $plugin;
    /**
     * 安装
     *
     * @param $version
     * @return void
     */
    public static function install($version) {}

    /**
     * 卸载
     *
     * @param $version
     * @return void
     */
    public static function uninstall($version) {}

    /**
     * 更新
     *
     * @param $from_version
     * @param $to_version
     * @param $context
     * @return void
     */
    public static function update($from_version, $to_version, $context = null) {}

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
        if (is_file($menu_file = $this->path . '/../admin.json')) {
            $content = file_get_contents($menu_file);
            if (!$content) {
                return false;
            }
            $data = json_decode($content, true);
            return $data;
        }
        return false;
    }
}
