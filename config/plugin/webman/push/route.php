<?php
/**
 * This file is part of webman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link      http://www.workerman.net/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

use support\Request;
use Webman\Route;

$enable=file_exists(base_path('plugin/notification'));
if($enable){
    /**
     * 推送js客户端文件
     */
    Route::get('/plugin/webman/push/push.js', function (Request $request) {
        return response()->file(base_path().'/vendor/webman/push/src/push.js');
    });
}