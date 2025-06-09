<?php

namespace process;

use app\expose\enum\State as EnumState;
use app\expose\helper\Config;
use plugin\human\app\model\PluginHumanAccount;
use plugin\human\app\model\PluginHumanVideo;
use plugin\human\app\model\PluginHumanScene;
use plugin\human\enum\AccountChannels;
use plugin\human\enum\State;
use plugin\human\utils\DeployUtils;
use plugin\human\utils\ToolsBase;
use think\facade\Db;
use Workerman\Crontab\Crontab;
use support\Log;
use support\Redis;
use Workerman\Timer;

class Test
{
    public function onWorkerStart()
    {
        $lock=false;
        new Crontab('*/9 * * * * *', function ()use(&$lock) {
            p($lock, 'test lock status');
            if ($lock) {
                return;
            }
            p('Test process started');
            $lock = true;
            try {
                Timer::sleep(60);
            } catch (\Throwable $e) {
                Log::error('Test process error: ' . $e->getMessage());
            } finally {
                $lock = false;
            }

        });
    }
}