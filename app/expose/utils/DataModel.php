<?php

namespace app\expose\utils;

use ArrayAccess;
use JsonSerializable;

/**
 * 数据序列化模型
 * 
 * 继承DataModel必须实现属性$data
 * @package app\utils
 * @property mixed $data
 * @method mixed __get(string $name)
 * @method void __set(string $name, mixed $value)
 * @method bool __isset(string $name)
 * @method void __unset(string $name)
 * @method string __toString()
 * @method mixed offsetGet(mixed $offset)
 * @method void offsetSet(mixed $offset, mixed $value)
 * @method bool offsetExists(mixed $offset)
 * @method void offsetUnset(mixed $offset)
 * @method array toArray()
 * @method string toJson()
 * @method array jsonSerialize()
 */
class DataModel implements ArrayAccess, JsonSerializable
{
    public function __get($name)
    {
        return $this->data[$name] ?? null;
    }
    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }
    public function __isset($name)
    {
        return isset($this->data[$name]);
    }
    public function __unset($name)
    {
        unset($this->data[$name]);
    }
    public function __toString()
    {
        return json_encode($this->data, JSON_UNESCAPED_UNICODE);
    }
    public function offsetGet(mixed $offset):mixed
    {
        return $this->data[$offset] ?? null;
    }
    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (is_null($offset)) {
            $this->data[] = $value;
        } else {
            $this->data[$offset] = $value;
        }
    }
    public function offsetExists(mixed $offset): bool
    {
        return $this->__isset($offset);
    }
    public function offsetUnset(mixed $offset): void
    {
        $this->__unset($offset);
    }
    public function toArray()
    {
        return $this->data;
    }
    public function toJson()
    {
        return json_encode($this->data, JSON_UNESCAPED_UNICODE);
    }
    public function jsonSerialize(): array
    {
        return $this->data;
    }
}
