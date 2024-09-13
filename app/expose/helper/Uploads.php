<?php

namespace app\expose\helper;

use app\expose\enum\Filesystem;
use app\model\Uploads as ModelUploads;
use app\model\UploadsClassify;
use Exception;
use GuzzleHttp\Client;
use Shopwwi\WebmanFilesystem\Facade\Storage;
use Webman\Http\UploadFile;

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
    public static function save($path)
    {
        $dir_name = 'uploads/save';
        $UploadsClassify = UploadsClassify::where(['dir_name' => $dir_name, 'is_system' => 1])->find();
        if (!$UploadsClassify) {
            $UploadsClassify = new UploadsClassify;
            $UploadsClassify->title = '本地保存';
            $UploadsClassify->dir_name = $dir_name;
            $UploadsClassify->channels = Filesystem::PUBLIC['value'];
            $UploadsClassify->sort = 0;
            $UploadsClassify->is_system = 1;
            $UploadsClassify->save();
        }
        $channels =  Filesystem::PUBLIC['value'];
        $date_path = date('Ymd');
        $originName=basename($path);
        //单文件上传
        $file = new UploadFile($path, $originName, mime_content_type($path), filesize($path));
        $result = Storage::adapter($channels)->path($dir_name . '/' . $date_path)->upload($file);
        $Uploads = new ModelUploads;
        $Uploads->classify_id = $UploadsClassify->id;
        $Uploads->filename = $result->origin_name;
        $Uploads->path = $result->file_name;
        $Uploads->ext = $result->extension;
        $Uploads->mime = $result->mime_type;
        $Uploads->size = $result->size;
        $Uploads->channels = $channels;
        $Uploads->save();
        return [
            'id' => $Uploads->id,
            'url' => $result->file_url,
            'path' => $result->file_name,
            'mime' => $result->mime_type,
            'dir_name' => $dir_name
        ];
    }
    public static function download($url)
    {
        $dir_name = 'uploads/remote';
        $UploadsClassify = UploadsClassify::where(['dir_name' => $dir_name, 'is_system' => 1])->find();
        if (!$UploadsClassify) {
            $UploadsClassify = new UploadsClassify;
            $UploadsClassify->title = '远程下载';
            $UploadsClassify->dir_name = $dir_name;
            $UploadsClassify->channels = Filesystem::PUBLIC['value'];
            $UploadsClassify->sort = 0;
            $UploadsClassify->is_system = 1;
            $UploadsClassify->save();
        }
        $channels =  Filesystem::PUBLIC['value'];
        $date_path = date('Ymd');
        $client = new Client();
        $response = $client->get($url);
        $body = $response->getBody();
        $file = $body->getContents();
        $urlPath = parse_url($url, PHP_URL_PATH);
        $ext = pathinfo($urlPath, PATHINFO_EXTENSION);
        $fileName = uniqid() . '.' . $ext;
        $temp = tempnam(sys_get_temp_dir(), '') . $fileName;
        file_put_contents($temp, $file);
        $file = new UploadFile($temp, $temp, $response->getHeaderLine('Content-Type'),  0);
        $result = Storage::adapter($channels)->path($dir_name . '/' . $date_path)->upload($file);
        \unlink($temp);
        $Uploads = new ModelUploads;
        $Uploads->classify_id = $UploadsClassify->id;
        $Uploads->filename = $result->origin_name;
        $Uploads->path = $result->file_name;
        $Uploads->ext = $result->extension;
        $Uploads->mime = $result->mime_type;
        $Uploads->size = $result->size;
        $Uploads->channels = $channels;
        $Uploads->save();
        return $result->file_name;
    }
}
