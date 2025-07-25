<?php

namespace app\expose\helper;

use app\expose\enum\Filesystem;
use app\model\Uploads as ModelUploads;
use app\model\UploadsClassify;
use Exception;
use GuzzleHttp\Client;
use Shopwwi\WebmanFilesystem\Facade\Storage;
use Shopwwi\WebmanFilesystem\FilesystemFactory;
use Webman\Http\UploadFile;

class Uploads
{
    /**
     * 获取文件URL
     * @param string|array|null $path 文件路径
     * @return string|array
     */
    public static function url(string|array|null $path)
    {
        if (empty($path)) {
            return $path;
        }
        if (is_array($path)) {
            $data = [];
            foreach ($path as $value) {
                $data[] = self::url($value);
            }
            return $data;
        }
        # 判断path是否以[?]开头,如果是则获取对应的key
        if (strpos($path, '[') === 0) {
            $key = substr($path, 1, strpos($path, ']') - 1);
            $model = new \stdClass;
            $model->channels = $key;
            $model->path = substr($path, strpos($path, ']') + 1);
        }else{
            $model = ModelUploads::where(['path' => $path])->find();
            if (!$model) {
                return $path;
            }
        }
        return Storage::adapter($model->channels)->url($model->path);
    }
    /**
     * 获取文件在本地存储的完整路径
     * @param string|array|null $path 文件路径
     * @return string|array
     */
    public static function local(string|array|null $path)
    {
        if (empty($path)) {
            return $path;
        }
        if (is_array($path)) {
            $data = [];
            foreach ($path as $value) {
                $data[] = self::local($value);
            }
            return $data;
        }
        if (strpos($path, '[') === 0) {
            $key = substr($path, 1, strpos($path, ']') - 1);
            $model = new \stdClass;
            $model->channels = $key;
            $model->path = substr($path, strpos($path, ']') + 1);
        }else{
            $model = ModelUploads::where(['path' => $path])->find();
            if (!$model) {
                return $path;
            }
        }
        $filesystem =  FilesystemFactory::get($model->channels);
        $has = $filesystem->has($model->path);
        if ($has) {
            if (in_array($model->channels, [Filesystem::LOCAL['value'], Filesystem::PUBLIC['value']])) {
                $config = config('plugin.shopwwi.filesystem.app.storage.' . $model->channels);
                return $config['root'] . $model->path;
            } else {
                return self::downloadTemp(Storage::adapter($model->channels)->url($model->path));
            }
        }
        return $path;
    }
    /**
     * 获取文件路径
     * @param string|array|null $url URL地址
     * @return string|array
     */
    public static function path(string|array|null $url)
    {
        if (empty($url)) {
            return '';
        }
        if (is_array($url)) {
            $data = [];
            if (count($url) === 1) {
                return self::path(current($url));
            }
            $config = config('plugin.shopwwi.filesystem.app.storage');
            $urls = [];
            foreach ($config as $key => $value) {
                if (empty($value['url'])) {
                    continue;
                }
                $urls[$key] = $value['url'];
            }
            foreach ($url as $value) {
                if (filter_var($value, FILTER_SANITIZE_URL) === false) {
                    throw new Exception('URL地址不合法');
                }
                $parseUrl = parse_url($value);
                $domain = $parseUrl['scheme'] . '://' . $parseUrl['host'];
                $key = array_search($domain, $urls);
                if ($key) {
                    $data[] = '[' . $key . ']' . ltrim($parseUrl['path'], '/');
                } else {
                    $data[] = ltrim($parseUrl['path'], '/');
                }
            }
            return $data;
        } else {
            if (filter_var($url, FILTER_SANITIZE_URL) === false) {
                throw new Exception('URL地址不合法');
            }
            $parseUrl = parse_url($url);
            $config = config('plugin.shopwwi.filesystem.app.storage');
            $urls = [];
            foreach ($config as $key => $value) {
                if (empty($value['url'])) {
                    continue;
                }
                $urls[$key] = $value['url'];
            }
            $domain = $parseUrl['scheme'] . '://' . $parseUrl['host'];
            $key = array_search($domain, $urls);
            if ($key) {
                $data = '[' . $key . ']' . ltrim($parseUrl['path'], '/');
            } else {
                $data     = ltrim($parseUrl['path'], '/');
            }
            return $data;
        }
    }
    /**
     * 保存文件
     * @param string $path 文件路径
     * @param string $channels 文件存储通道
     * @param string $dir_name 文件存储目录
     * @param string $title 文件分类标题
     * @return array
     */
    public static function save(string $path, $channels = Filesystem::PUBLIC['value'], $dir_name = 'uploads/save', $title = '本地保存')
    {
        $UploadsClassify = UploadsClassify::where(['dir_name' => $dir_name, 'channels' => $channels])->find();
        if (!$UploadsClassify) {
            $UploadsClassify = new UploadsClassify;
            $UploadsClassify->title = $title;
            $UploadsClassify->dir_name = $dir_name;
            $UploadsClassify->channels = $channels;
            $UploadsClassify->sort = 0;
            $UploadsClassify->is_system = 1;
            $UploadsClassify->save();
        }
        $date_path = date('Ymd');
        $originName = basename($path);
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
    /**
     * 远程下载文件
     * @param string $url 文件URL
     * @param string $channels 文件存储通道
     * @return string
     */
    public static function download(string $url, $channels = Filesystem::PUBLIC['value'])
    {
        $dir_name = 'uploads/remote';
        $UploadsClassify = UploadsClassify::where(['dir_name' => $dir_name, 'is_system' => 1])->find();
        if (!$UploadsClassify) {
            $UploadsClassify = new UploadsClassify;
            $UploadsClassify->title = '远程下载';
            $UploadsClassify->dir_name = $dir_name;
            $UploadsClassify->channels = $channels;
            $UploadsClassify->sort = 0;
            $UploadsClassify->is_system = 1;
            $UploadsClassify->save();
        }
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
    /**
     * 下载文件到临时文件
     * @param string $url 文件URL
     * @return string 临时文件路径
     */
    public static function downloadTemp(string $url)
    {
        $client = new Client();
        $response = $client->get($url);
        $body = $response->getBody();
        $file = $body->getContents();
        $urlPath = parse_url($url, PHP_URL_PATH);
        $ext = pathinfo($urlPath, PATHINFO_EXTENSION);
        $fileName = uniqid() . '.' . $ext;
        $temp = runtime_path('temp/' . $fileName);
        file_put_contents($temp, $file);
        return $temp;
    }
    /**
     * 上传文件
     * @param string $path 文件路径
     * @param string $channels 文件存储通道
     * @param string $dir_name 文件存储目录
     * @return array
     */
    public static function upload(string $path, $channels = Filesystem::PUBLIC['value'], $dir_name = 'uploads/save')
    {
        $date_path = date('Ymd');
        $originName = basename($path);
        //单文件上传
        $file = new UploadFile($path, $originName, mime_content_type($path), filesize($path));
        $result = Storage::adapter($channels)->path($dir_name . '/' . $date_path)->upload($file);
        $Uploads = new ModelUploads;
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
    /**
     * 删除文件
     * @param string $path 文件路径
     * @return bool
     */
    public static function delete(string $path)
    {
        $model = ModelUploads::where(['path' => $path])->find();
        if (!$model) {
            return true;
        }
        $filesystem =  FilesystemFactory::get($model->channels);
        $filesystem->delete($model->path);
        $model->delete();
        return true;
    }
    /**
     * 重命名文件
     * @param string $path 文件路径
     * @param string $newName 新文件名
     * @return bool
     */
    public static function rename(string $path, string $newName)
    {
        $model = ModelUploads::where(['path' => $path])->find();
        if (!$model) {
            return false;
        }
        $filesystem =  FilesystemFactory::get($model->channels);
        $filesystem->move($model->path, $newName);
        $model->path = $newName;
        $model->save();
        return true;
    }
    /**
     * 判断文件是否存在
     * @param string $path 文件路径
     * @return bool
     */
    public static function has(string $path)
    {
        $model = ModelUploads::where(['path' => $path])->find();
        if (!$model) {
            return false;
        }
        $filesystem =  FilesystemFactory::get($model->channels);
        return $filesystem->has($model->path);
    }
    /**
     * 复制文件
     * @param string $path 文件路径
     * @param string $newName 新文件名
     * @return bool
     */
    public static function copy(string $path, string $newName)
    {
        $model = ModelUploads::where(['path' => $path])->find();
        if (!$model) {
            return false;
        }
        $filesystem =  FilesystemFactory::get($model->channels);
        $filesystem->copy($model->path, $newName);
        $model = new ModelUploads;
        $model->classify_id = $model->classify_id;
        $model->filename = $model->filename;
        $model->path = $newName;
        $model->ext = $model->ext;
        $model->mime = $model->mime;
        $model->size = $model->size;
        $model->path = $newName;
        $model->save();
        return true;
    }
    /**
     * 获取文件列表
     * @param string $path 文件路径
     * @param bool $recursive 是否递归
     * @return array
     */
    public static function listContents(string $path, $recursive = false)
    {
        $model = ModelUploads::where(['path' => $path])->find();
        if (!$model) {
            return false;
        }
        $filesystem =  FilesystemFactory::get($model->channels);
        return $filesystem->listContents($path, $recursive);
    }
}
