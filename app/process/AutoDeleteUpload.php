<?php

namespace app\process;

use app\model\Uploads;
use Shopwwi\WebmanFilesystem\FilesystemFactory;
use support\Log;
use Workerman\Crontab\Crontab;
class AutoDeleteUpload
{
    public function onWorkerStart($worker)
    {
        # 查询冻结超过24小时的订单，解冻
        new Crontab('0 */1 * * * *', function(){
            $models=Uploads::whereNotNull('auto_delete_time')->whereTime('auto_delete_time','<',date('Y-m-d H:i:s'))->select();
            foreach ($models as $model) {
                try {
                    $filesystem =  FilesystemFactory::get($model->channels);
                    $filesystem->delete($model->path);
                    $model->delete();
                } catch (\Throwable $th) {
                    Log::error('删除文件"'.$model->path.'"失败：'.$th->getMessage(),$th->getTrace());
                }
            }
        });
    }
}