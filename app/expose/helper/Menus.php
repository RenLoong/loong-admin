<?php

namespace app\expose\helper;

use app\expose\utils\DataModel;

class Menus extends DataModel
{
    public $data = [];
    public $itemData = [
        # 菜单标题
        "title"         => "Title",
        # 菜单图标，element-plus中的Icon名称，如：ElementPlus
        "icon"          => "",
        # 路由路径
        "path"          => "",
        # 使用组件，table：表格列表，form：表单，images：图片列表
        "component"     => "default",
        # 请求方式，GET,POST,PUT,DELETE
        "methods"       => ["GET"],
        # 是否显示，0：隐藏，1：显示
        "show"          => 1,
        # 排序，正序
        "sort"          => 9999,
        # 携带地址栏参数
        "query"         => [],
        # 携带post参数
        "params"        => [],
        # 路由meta
        "meta"          => [
            "login" => true,
        ],
        # 子级和父级参数一致
        "children"      => []
    ];
    /**
     * 构造函数
     *
     * @param object $Install 需实现 getMenus 方法的类返回菜单数据
     */
    public function __construct($Install)
    {
        $request = request();
        $lang = null;
        if ($request && $request->lang) {
            $lang = $request->lang;
        }
        $data = $Install->getMenus();
        $request = request();
        if ($lang) {
            $this->translateChildren($data, $request->app,$lang);
        }
        foreach (glob(base_path('plugin/*')) as $path) {
            $plugin_name = basename($path);
            $class = 'plugin\\' . $plugin_name . '\\api\\Install';
            $plugin = new $class;
            $menus = $plugin->getMenus();
            if ($menus) {
                if ($lang&&$plugin->getPlugin()) {
                    $request->plugin = $plugin_name;
                    $this->translateChildren($menus, $request->app,$lang);
                }
                $data[] = $menus;
            }
        }
        $this->builder($data);
    }
    public function translateChildren(&$data, $domain,$lang)
    {
        if (is_array($data) && isset($data[0])) {
            foreach ($data as $key => &$item) {
                if (isset($item['title'])) {
                    $data[$key]['title'] = trans($item['title'], [], $domain, $lang);
                }
                if (!empty($item['children'])) {
                    $this->translateChildren($item['children'],$domain, $lang);
                }
            }
        } else {
            if (isset($data['title'])) {
                $data['title'] = trans($data['title'], [], $domain, $lang);
            }
            if (!empty($data['children'])) {
                $this->translateChildren($data['children'],$domain, $lang);
            }
        }
    }
    /**
     * 递归合并
     *
     * @param array $data
     * @return $data
     */
    public function mergeMenus(array $data): array
    {
        $result = [];
        foreach ($data as $key => $item) {
            $temp = array_merge($this->itemData, $item);
            if (!empty($temp['children'])) {
                $temp['children'] = $this->mergeMenus($temp['children']);
            }
            $result[] = $temp;
        }
        return $result;
    }
    /**
     * 构建菜单
     *
     * @param array $data
     * @return Menus
     */
    public function builder(array $data)
    {
        $this->data = $this->mergeMenus($data);
        return $this;
    }
}
