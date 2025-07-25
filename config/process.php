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

use app\process\AutoDeleteUpload;
use support\Log;
use support\Request;
use app\process\Http;
use app\process\Monitor;
use Workerman\Events\Swoole;

global $argv;

return [
    'webman' => [
        'handler' => Http::class,
        'listen' => 'http://0.0.0.0:' . getenv('SERVER_PORT'),
        'name' => getenv('SERVER_NAME') ? getenv('SERVER_NAME') : 'webman',
        'count' => getenv('DEBUG') == 'true' ? 1 : cpu_count(),
        'user' => '',
        'group' => '',
        'reusePort' => false,
        'eventLoop' => Swoole::class,
        'context' => [],
        'constructor' => [
            'requestClass' => Request::class,
            'logger' => Log::channel('default'),
            'appPath' => app_path(),
            'publicPath' => public_path()
        ]
    ],
    // File update detection and automatic reload
    'monitor' => [
        'handler' => Monitor::class,
        'reloadable' => false,
        'constructor' => [
            // Monitor these directories
            'monitorDir' => array_merge([
                app_path(),
                config_path(),
                base_path() . '/process',
                base_path() . '/support',
                base_path() . '/resource',
                base_path() . '/.env',
            ], glob(base_path() . '/plugin/*/app'), glob(base_path() . '/plugin/*/config'), glob(base_path() . '/plugin/*/api')),
            // Files with these suffixes will be monitored
            'monitorExtensions' => [
                'php',
                'html',
                'htm',
                'env'
            ],
            'options' => [
                'enable_file_monitor' => !in_array('-d', $argv) && DIRECTORY_SEPARATOR === '/',
                'enable_memory_monitor' => DIRECTORY_SEPARATOR === '/',
            ]
        ]
    ],
    'AutoDeleteUpload' => [
        'handler' => AutoDeleteUpload::class,
        'eventLoop' => Swoole::class,
    ]
];
