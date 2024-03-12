<?php

namespace app\expose\enum\builder;

class Enum
{
    public static function getOptions()
    {
        $class = new \ReflectionClass(static::class);
        $options = [];
        foreach ($class->getConstants() as $key => $value) {
            if (is_array($value)) {
                $options[] = $value;
            } else {
                $options[] = [
                    'label' => $key,
                    'value' => $value
                ];
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
    public static function getValues($filter = null)
    {
        $options = static::getOptions();
        $values = [];
        foreach ($options as $option) {
            if ($filter && !in_array($option['value'], $filter)) {
                continue;
            }
            $values[] = $option['value'];
        }
        return $values;
    }
}
