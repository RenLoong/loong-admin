<?php

namespace app\model;

class AdminRole extends Basic
{
    public $json = ['rule'];
    public $jsonAssoc = true;
    public static function getOptions($pid = null, $where = [])
    {
        if ($pid) {
            $data = self::where($where)->where(['pid' => $pid])->select();
        } else {
            $data = self::where($where)->whereNull('pid')->select();
        }
        $options = [];
        if ($data->isEmpty()) {
            return $options;
        }
        foreach ($data as $item) {
            $temp = [
                'value' => $item->id,
                'label' => $item['name']
            ];
            $children = self::getOptions($item->id, $where);
            if (!empty($children)) {
                $temp['children'] = $children;
            }
            $options[] = $temp;
        }
        return $options;
    }
    public static function getSystemRole($column = '*')
    {
        return self::where('is_system', 1)->column($column);
    }
}
