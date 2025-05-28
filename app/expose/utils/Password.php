<?php

namespace app\expose\utils;

class Password
{
    /**
     * 获取密码散列值
     *
     * @param string $password
     * @param [type] $algo
     * @return string
     */
    public static function encrypt(string $password, string $algo = PASSWORD_DEFAULT): string
    {
        return password_hash($password, $algo);
    }

    /**
     * 验证密码
     *
     * @param string $password
     * @param string $hash
     * @return boolean
     */
    public static function verify(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }
}
