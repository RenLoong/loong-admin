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
        return false;
    }
    public function getPermissions(){
        $menus = $this->getMenus();
        $permissions = [];
        $this->getPath($menus,$permissions);
        return $permissions;
    }
    public function getPath($arr,&$data)
    {
        if(isset($arr['path'])){
            $data[] = $arr['path'];
            if(isset($arr['children'])){
                $this->getPath($arr['children'],$data);
            }
        }else{
            foreach ($arr as $key => $value) {
                if (isset($value['path'])) {
                    $data[] = $value['path'];
                }
                if (isset($value['children'])) {
                    $this->getPath($value['children'],$data);
                }
            }
        }
    }
}
