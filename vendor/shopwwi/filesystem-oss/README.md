#安装
```
composer require shopwwi/flysystem-oss
```
#感谢
```
借鉴了 xxtime/flysystem-aliyun-oss 部分代码，在此表示感谢。
```
# Usage

```
use League\Flysystem\Filesystem;
use Shopwwi\FilesystemOss\OssAdapter;

$aliyun = new OssAdapter([
    'accessId'       => '<aliyun access id>',
    'accessSecret'   => '<aliyun access secret>',
    'bucket'         => '<bucket name>',
    'endpoint'       => '<endpoint address>',
    // 'timeout'        => 3600,
    // 'connectTimeout' => 10,
    // 'isCName'        => false,
    // 'token'          => '',
]);
$filesystem = new Filesystem($aliyun);


// Write Files
$filesystem->write('path/to/file.txt', 'contents');
// get RAW data from aliYun OSS
$raw = $aliyun->supports->getFlashData();

// Write Use writeStream
$stream = fopen('local/path/to/file.txt', 'r+');
$result = $filesystem->writeStream('path/to/file.txt', $stream);
if (is_resource($stream)) {
    fclose($stream);
}

// Update Files
$filesystem->update('path/to/file.txt', 'new contents');

// Check if a file exists
$exists = $filesystem->has('path/to/file.txt');

// Read Files
$contents = $filesystem->read('path/to/file.txt');

// Delete Files
$filesystem->delete('path/to/file.txt');

// Rename Files
$filesystem->rename('filename.txt', 'newname.txt');

// Copy Files
$filesystem->copy('filename.txt', 'duplicate.txt');


// list the contents (not support recursive now)
$filesystem->listContents('path', false);
```
