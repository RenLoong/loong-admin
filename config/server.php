<?php
return [
    'listen' => 'http://0.0.0.0:' . getenv('SERVER_PORT'),
    'transport' => 'tcp',
    'context' => [],
    'name' => getenv('SERVER_NAME') ? getenv('SERVER_NAME') : 'webman',
    'count' => getenv('DEBUG') == 'true' ? 1 : cpu_count() * 4,
    'user' => '',
    'group' => '',
    'reusePort' => false,
    'event_loop' => '',
    'stop_timeout' => 2,
    'pid_file' => runtime_path() . '/webman.pid',
    'status_file' => runtime_path() . '/webman.status',
    'stdout_file' => runtime_path() . '/logs/stdout.log',
    'log_file' => runtime_path() . '/logs/workerman.log',
    'max_package_size' => 10 * 1024 * 1024
];
