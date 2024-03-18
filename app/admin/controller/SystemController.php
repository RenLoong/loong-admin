<?php

namespace app\admin\controller;

use app\Basic;
use app\expose\build\builder\ComponentBuilder;
use app\expose\build\builder\FormBuilder;
use app\expose\enum\Filesystem;
use app\expose\enum\SubmitEvent;
use app\expose\trait\Config;
use support\Request;

class SystemController extends Basic
{
    use Config;
    public function basic(Request $request)
    {
        return $this->builder();
    }
    public function payment(Request $request)
    {
        return $this->builder();
    }
    public function sms(Request $request)
    {
        return $this->tabsBuilder();
    }
    public function upload(Request $request)
    {
        $request = request();
        if ($request->method() === 'POST') {
            $D = $request->post();
            $config = [];
            $config['default'] = $D['default'];
            $config['max_size'] = (int)$D['max_size'];
            $config['storage']['public']['url'] = $D['public']['url'];
            $config['storage']['local']['url'] = $D['local']['url'];
            foreach ($D['ftp'] as $key => $value) {
                $config['storage']['ftp'][$key] = $value;
            }
            foreach ($D['s3'] as $key => $value) {
                if (in_array($key, ['key', 'secret'])) {
                    $config['storage']['s3']['credentials'][$key] = $value;
                } else {
                    $config['storage']['s3'][$key] = $value;
                }
            }
            foreach ($D['minio'] as $key => $value) {
                if (in_array($key, ['key', 'secret'])) {
                    $config['storage']['minio']['credentials'][$key] = $value;
                } else {
                    $config['storage']['minio'][$key] = $value;
                }
            }
            foreach ($D['oss'] as $key => $value) {
                $config['storage']['oss'][$key] = $value;
            }
            foreach ($D['qiniu'] as $key => $value) {
                $config['storage']['qiniu'][$key] = $value;
            }
            foreach ($D['cos'] as $key => $value) {
                $config['storage']['cos'][$key] = $value;
            }
            $content = json_encode($config, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            $user = config_path("plugin/shopwwi/filesystem/app.json");
            $res = file_put_contents($user, $content);
            if ($res) {
                return $this->success('保存成功，重启服务生效');
            }
            return $this->fail('保存失败');
        }
        $config = config('plugin.shopwwi.filesystem.app');
        $builder = new FormBuilder(null, null, [
            'submitEvent' => SubmitEvent::SILENT
        ]);
        $defaultOptions = Filesystem::getOptions();
        $builder->add('default', '默认存储渠道商', 'select', $config['default'], [
            'options' => $defaultOptions
        ]);
        $builder->add('max_size', '单个文件大小(字节)', 'input-number', $config['max_size'], [
            'props' => [
                'min' => 0,
                'controls' => false,
                'style' => [
                    'width' => '200px'
                ]
            ]
        ]);
        $Component = new ComponentBuilder;
        $subBuilder = new FormBuilder('public', '本地存储(外部)');
        $subBuilder->add('url', '静态文件访问域名', 'input', $config['storage']['public']['url'], [
            'prompt' => [
                $Component->add('text', ['default' => '对外访问域名，不以斜杠结尾'], ['type' => 'info', 'size' => 'small'])
                    ->builder()
            ],
            'props' => [
                'placeholder' => 'http://static.example.com'
            ]
        ]);
        $builder->addGroupForm($subBuilder);

        $subBuilder = new FormBuilder('local', '本地存储(内部)');
        $subBuilder->add('url', '静态文件访问域名', 'input', $config['storage']['local']['url'], [
            'prompt' => [
                $Component->add('text', ['default' => '对外访问域名，不以斜杠结尾'], ['type' => 'info', 'size' => 'small'])
                    ->builder()
            ],
            'props' => [
                'placeholder' => 'http://static.example.com'
            ]
        ]);
        $builder->addGroupForm($subBuilder);

        $subBuilder = new FormBuilder('ftp', 'FTP存储');
        $subBuilder->add('host', 'HOST', 'input', $config['storage']['ftp']['host']);
        $subBuilder->add('username', 'UserName', 'input', $config['storage']['ftp']['username']);
        $subBuilder->add('password', 'Password', 'input', $config['storage']['ftp']['password']);
        $subBuilder->add('port', 'Port', 'input', $config['storage']['ftp']['port']);
        $subBuilder->add('root', '目录', 'input', $config['storage']['ftp']['root']);
        $subBuilder->add('passive', '被动模式', 'switch', $config['storage']['ftp']['passive']);
        $subBuilder->add('ssl', 'SSL', 'switch', $config['storage']['ftp']['ssl']);
        $subBuilder->add('timeout', '超时', 'input-number', $config['storage']['ftp']['timeout']);
        $subBuilder->add('url', '静态文件访问域名', 'input', $config['storage']['ftp']['url'], [
            'prompt' => [
                $Component->add('text', ['default' => '对外访问域名，不以斜杠结尾'], ['type' => 'info', 'size' => 'small'])
                    ->builder()
            ],
            'props' => [
                'placeholder' => 'http://static.example.com'
            ]
        ]);
        $builder->addGroupForm($subBuilder);

        $subBuilder = new FormBuilder('s3', 'S3存储');
        $subBuilder->add('key', 'KEY', 'input', $config['storage']['s3']['credentials']['key']);
        $subBuilder->add('secret', 'Secret', 'input', $config['storage']['s3']['credentials']['secret']);
        $subBuilder->add('region', 'Region', 'input', $config['storage']['s3']['region']);
        $subBuilder->add('version', 'Version', 'input', $config['storage']['s3']['version']);
        $subBuilder->add('bucket_endpoint', 'Bucket Endpoint', 'switch', $config['storage']['s3']['bucket_endpoint']);
        $subBuilder->add('use_path_style_endpoint', 'Use path style endpoint', 'switch', $config['storage']['s3']['use_path_style_endpoint']);
        $subBuilder->add('endpoint', 'Endpoint', 'input', $config['storage']['s3']['endpoint']);
        $subBuilder->add('bucket_name', 'Bucket Name', 'input', $config['storage']['s3']['bucket_name']);
        $subBuilder->add('url', '静态文件访问域名', 'input', $config['storage']['s3']['url'], [
            'prompt' => [
                $Component->add('text', ['default' => '对外访问域名，不以斜杠结尾'], ['type' => 'info', 'size' => 'small'])
                    ->builder()
            ],
            'props' => [
                'placeholder' => 'http://static.example.com'
            ]
        ]);
        $builder->addGroupForm($subBuilder);

        $subBuilder = new FormBuilder('minio', 'Minio存储');
        $subBuilder->add('key', 'KEY', 'input', $config['storage']['minio']['credentials']['key']);
        $subBuilder->add('secret', 'Secret', 'input', $config['storage']['minio']['credentials']['secret']);
        $subBuilder->add('region', 'Region', 'input', $config['storage']['minio']['region']);
        $subBuilder->add('version', 'Version', 'input', $config['storage']['minio']['version']);
        $subBuilder->add('bucket_endpoint', 'Bucket Endpoint', 'switch', $config['storage']['minio']['bucket_endpoint']);
        $subBuilder->add('use_path_style_endpoint', 'Use path style endpoint', 'switch', $config['storage']['minio']['use_path_style_endpoint']);
        $subBuilder->add('endpoint', 'Endpoint', 'input', $config['storage']['minio']['endpoint']);
        $subBuilder->add('bucket_name', 'Bucket Name', 'input', $config['storage']['minio']['bucket_name']);
        $subBuilder->add('url', '静态文件访问域名', 'input', $config['storage']['minio']['url'], [
            'prompt' => [
                $Component->add('text', ['default' => '对外访问域名，不以斜杠结尾'], ['type' => 'info', 'size' => 'small'])
                    ->builder()
            ],
            'props' => [
                'placeholder' => 'http://static.example.com'
            ]
        ]);
        $builder->addGroupForm($subBuilder);

        $subBuilder = new FormBuilder('oss', '阿里云存储');
        $subBuilder->add('accessId', 'AccessId', 'input', $config['storage']['oss']['accessId']);
        $subBuilder->add('accessSecret', 'AccessSecret', 'input', $config['storage']['oss']['accessSecret']);
        $subBuilder->add('bucket', 'Bucket', 'input', $config['storage']['oss']['bucket']);
        $subBuilder->add('endpoint', 'Bucket域名', 'input', $config['storage']['oss']['endpoint']);
        $subBuilder->add('isCName', '私有空间', 'switch', $config['storage']['oss']['isCName']);
        $subBuilder->add('url', '静态文件访问域名', 'input', $config['storage']['oss']['url'], [
            'prompt' => [
                $Component->add('text', ['default' => '对外访问域名，不以斜杠结尾'], ['type' => 'info', 'size' => 'small'])
                    ->builder()
            ],
            'props' => [
                'placeholder' => 'http://static.example.com'
            ]
        ]);
        $builder->addGroupForm($subBuilder);

        $subBuilder = new FormBuilder('qiniu', '七牛存储');
        $subBuilder->add('accessKey', 'AccessKey', 'input', $config['storage']['qiniu']['accessKey']);
        $subBuilder->add('secretKey', 'SecretKey', 'input', $config['storage']['qiniu']['secretKey']);
        $subBuilder->add('bucket', 'Bucket', 'input', $config['storage']['qiniu']['bucket']);
        $subBuilder->add('domain', 'Domain', 'input', $config['storage']['qiniu']['domain']);
        $subBuilder->add('url', '静态文件访问域名', 'input', $config['storage']['qiniu']['url'], [
            'prompt' => [
                $Component->add('text', ['default' => '对外访问域名，不以斜杠结尾'], ['type' => 'info', 'size' => 'small'])
                    ->builder()
            ],
            'props' => [
                'placeholder' => 'http://static.example.com'
            ]
        ]);
        $builder->addGroupForm($subBuilder);

        $subBuilder = new FormBuilder('cos', '腾讯云存储');
        $subBuilder->add('app_id', 'Appid', 'input', $config['storage']['cos']['app_id']);
        $subBuilder->add('secret_id', 'SecretId', 'input', $config['storage']['cos']['secret_id']);
        $subBuilder->add('secret_key', 'SecretKey', 'input', $config['storage']['cos']['secret_key']);
        $subBuilder->add('region', 'Region', 'input', $config['storage']['cos']['region']);
        $subBuilder->add('bucket', 'Bucket', 'input', $config['storage']['cos']['bucket']);
        $subBuilder->add('read_from_cdn', '从CDN读取', 'switch', $config['storage']['cos']['read_from_cdn']);
        $subBuilder->add('signed_url', '私有空间', 'switch', $config['storage']['cos']['signed_url']);
        $subBuilder->add('url', '静态文件访问域名', 'input', $config['storage']['cos']['url'], [
            'prompt' => [
                $Component->add('text', ['default' => '对外访问域名，不以斜杠结尾'], ['type' => 'info', 'size' => 'small'])
                    ->builder()
            ],
            'props' => [
                'placeholder' => 'http://static.example.com'
            ]
        ]);
        $builder->addGroupForm($subBuilder);
        return $this->resData($builder);
    }
}
