<?php

namespace app\expose\helper;

use app\model\Uploads as ModelUploads;
use Exception;
use Shopwwi\WebmanFilesystem\Facade\Storage;

class Uploads
{
    public static function url(string|array|null $path)
    {
        if (is_null($path)) {
            return '';
        }
        if (is_array($path)) {
            $data = [];
            foreach ($path as $value) {
                $model = ModelUploads::where(['path' => $value])->find();
                if (!$model) {
                    $data[] = '';
                } else {
                    $data[] = Storage::adapter($model->channels)->url($model->path);
                }
            }
            return $data;
        }
        $model = ModelUploads::where(['path' => $path])->find();
        if (!$model) {
            return '';
        }
        return Storage::adapter($model->channels)->url($model->path);
    }
    public static function path(string|array|null $url)
    {
        if (is_null($url)) {
            return '';
        }
        if (is_array($url)) {
            $data = [];
            if (count($url) === 1) {
                return self::path(current($url));
            }
            foreach ($url as $value) {
                if (filter_var($value, FILTER_SANITIZE_URL) === false) {
                    throw new Exception('URL地址不合法');
                }
                $parseUrl = parse_url($value);
                $data[]   = ltrim($parseUrl['path'], '/');
            }
            return $data;
        } else {
            if (filter_var($url, FILTER_SANITIZE_URL) === false) {
                throw new Exception('URL地址不合法');
            }
            $parseUrl = parse_url($url);
            $data     = ltrim($parseUrl['path'], '/');
            return $data;
        }
    }
}
