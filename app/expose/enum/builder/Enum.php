<?php

namespace app\expose\enum\builder;

class Enum
{
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
    public static function getValues(?callable $filter = null)
    {
        $options = static::getOptions($filter);
        $values = [];
        foreach ($options as $option) {
            $values[] = $option['value'];
        }
        return $values;
    }
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
