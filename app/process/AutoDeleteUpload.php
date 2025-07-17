<?php

namespace app\process;

use app\model\Uploads;
use Shopwwi\WebmanFilesystem\FilesystemFactory;
use Workerman\Crontab\Crontab;
class AutoDeleteUpload
{
    public function onWorkerStart($worker)
    {
        # 查询冻结超过24小时的订单，解冻
        new Crontab('0 */1 * * * *', function(){
            print_r('AutoDeleteUpload');
            $models=Uploads::whereNotNull('auto_delete_time')->whereTime('auto_delete_time','<',date('Y-m-d H:i:s'))->select();
            foreach ($models as $model) {
                print_r($model->path);
                $filesystem =  FilesystemFactory::get($model->channels);
                $filesystem->delete($model->path);
                $model->delete();
            }
        });
    }
}