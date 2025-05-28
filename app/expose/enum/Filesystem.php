<?php

namespace app\expose\enum;

use app\expose\enum\builder\Enum;

class Filesystem extends Enum
{
    const PUBLIC = [
        'label' => '本地存储(外部)',
        'value' => 'public'
    ];
    const LOCAL = [
        'label' => '本地存储(内部)',
        'value' => 'local'
    ];
    const FTP = [
        'label' => 'FTP存储',
        'value' => 'ftp'
    ];
    const S3 = [
        'label' => 'S3存储',
        'value' => 's3'
    ];
    const MINIO = [
        'label' => 'Minio存储',
        'value' => 'minio'
    ];
    const OSS = [
        'label' => '阿里云存储',
        'value' => 'oss'
    ];
    const QINIU = [
        'label' => '七牛存储',
        'value' => 'qiniu'
    ];
    const COS = [
        'label' => '腾讯云存储',
        'value' => 'cos'
    ];
}
