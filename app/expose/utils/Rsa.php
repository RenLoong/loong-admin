<?php

namespace app\expose\utils;

use \Exception;

/**
 * RAS加解密
 */
class Rsa
{
    /**
     * 解密
     *
     * @param string 加密后的字符串
     * @param string 私钥，可以是文件路径
     * @return object
     */
    public static function decrypt($token, $rsa_privatekey)
    {
        if (file_exists($rsa_privatekey)) {
            $rsa_privatekey = @file_get_contents($rsa_privatekey);
        }
        if (empty($rsa_privatekey)) {
            throw new Exception('私钥为空');
        }
        $split = str_split($token, 172); // 1024 bit  固定172
        $crypto = '';
        foreach ($split as $chunk) {
            $isOkay = openssl_private_decrypt(base64_decode($chunk), $decryptData, $rsa_privatekey); // base64在这里使用，因为172字节是一组，是encode来的
            if (!$isOkay) {
                throw new Exception("解密失败");
            }
            $crypto .= $decryptData;
        }
        if (!$crypto) {
            throw new Exception("解密失败");
        }
        return json_decode(base64_decode($crypto));
    }
    /**
     * 加密
     *
     * @param mixed 可被json序列化的数据
     * @param string 公钥，可以是文件路径
     * @return string
     */
    public static function encrypt(mixed $data, string $rsa_publickey)
    {
        if (file_exists($rsa_publickey)) {
            $rsa_publickey = @file_get_contents($rsa_publickey);
        }
        if (empty($rsa_publickey)) {
            throw new Exception('公钥为空');
        }
        $data = base64_encode(json_encode($data));
        $split = str_split($data, 117); // 1024 bit && OPENSSL_PKCS1_PADDING  不大于117即可
        $crypto = '';
        foreach ($split as $chunk) {
            $isOkay = openssl_public_encrypt($chunk, $encryptData, $rsa_publickey);
            if (!$isOkay) {
                throw new Exception("加密失败");
            }
            $crypto .= base64_encode($encryptData);
        }
        return $crypto;
    }
    /**
     * 创建一对公钥私钥
     *
     * @return array
     */
    public static function createKey()
    {
        $res = openssl_pkey_new([
            "private_key_bits" => 2048,
            "private_key_type" => OPENSSL_KEYTYPE_RSA
        ]);
        openssl_pkey_export($res, $privKey);
        $pubKey = openssl_pkey_get_details($res);
        return [
            'privatekey' => $privKey,
            'publickey' => $pubKey["key"]
        ];
    }
    # 以下是数字加密解密
    const PASSWORD = 'MAW512P89WIAUW9G7OHQWVGAPX51WPSN';
    /**
     * 数字加密函数
     *
     * @param int $number
     * @param string $password
     * @return string
     */
    public static function encryptNumber(int $number, string $password = '')
    {
        // 生成随机的初始向量
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $password = $password ?: self::PASSWORD;
        // 加密数字
        $encrypted = openssl_encrypt($number, 'aes-256-cbc', $password, 0, $iv);

        // 将初始向量和加密后的数据进行编码并拼接起来
        $encoded = base64_encode($iv . $encrypted);

        return $encoded;
    }
    /**
     * 数字解密函数
     *
     * @param string $encrypted
     * @param string $password
     * @return int
     */
    public static function decryptNumber(string $encrypted, string $password = '')
    {
        // 解码加密后的数据
        $decoded = base64_decode($encrypted);

        // 提取初始向量和加密后的数据
        $ivLength = openssl_cipher_iv_length('aes-256-cbc');
        $iv = substr($decoded, 0, $ivLength);
        $encryptedData = substr($decoded, $ivLength);

        $password = $password ?: self::PASSWORD;

        // 解密数据
        $decrypted = openssl_decrypt($encryptedData, 'aes-256-cbc', $password, 0, $iv);

        return $decrypted;
    }
}
