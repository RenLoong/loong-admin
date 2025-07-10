<?php

namespace app\expose\enum\builder;

class Enum
{
    /**
     * 获取枚举选项
     * @param callable|null $filter 过滤函数
     * @return array 选项数组
     */
    public static function getOptions(?callable $filter = null)
    {
        $class = new \ReflectionClass(static::class);
        $options = [];
        foreach ($class->getConstants() as $key => $value) {
            if ($filter) {
                if ($filter($value)) {
                    if (is_array($value)) {
                        $options[] = $value;
                    } else {
                        $options[] = [
                            'label' => $key,
                            'value' => $value
                        ];
                    }
                }
            }else{
                if (is_array($value)) {
                    $options[] = $value;
                } else {
                    $options[] = [
                        'label' => $key,
                        'value' => $value
                    ];
                }
            }
        }
        return $options;
    }
    /**
     * 获取枚举文本
     * @param mixed $value 值
     * @return string 文本
     */
    public static function getText($value)
    {
        $options = static::getOptions();
        foreach ($options as $option) {
            if ($option['value'] == $value) {
                return $option['label'];
            }
        }
        return '';
    }
    /**
     * 获取枚举选项
     * @param mixed $value 值
     * @return array|null 选项
     */
    public static function get($value)
    {
        $options = static::getOptions();
        foreach ($options as $option) {
            if ($option['value'] == $value) {
                return $option;
            }
        }
        return null;
    }
    /**
     * 获取枚举值
     * @param callable|null $filter 过滤函数
     * @return array 值数组
     */
    public static function getValues(?callable $filter = null)
    {
        $options = static::getOptions($filter);
        $values = [];
        foreach ($options as $option) {
            $values[] = $option['value'];
        }
        return $values;
    }
    /**
     * 判断是否存在
     * @param mixed $value 值
     * @return bool 是否存在
     */
    public static function has($value)
    {
        $options = static::getOptions();
        foreach ($options as $option) {
            if ($option['value'] == $value) {
                return true;
            }
        }
        return false;
    }
}
