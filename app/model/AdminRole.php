<?php

namespace app\model;

class AdminRole extends Basic
{
    public static function getOptions($pid = null)
    {
        if ($pid) {
            $data = self::where(['pid' => $pid])->select();
        } else {
            $data = self::whereNull('pid')->select();
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
            $children = self::getOptions($item->id);
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
