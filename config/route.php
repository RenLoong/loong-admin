<?php

use Webman\Route;


Route::any('/notify/wechat/{plugin}/{template_id}', [app\controller\NotifyController::class, 'wechat']);
require_once app_path('admin/config/route.php');
