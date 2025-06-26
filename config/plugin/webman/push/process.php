<?php
use Webman\Push\Server;
$enable=file_exists(base_path('plugin/notification'));
return [
    'server' => [
        'enable' => $enable,
        'handler' => Server::class,
        'listen' => 'websocket://0.0.0.0:'.getenv('PUSH_WSS_PORT'),
        'count' => 1,
        'constructor' => [
            'api_listen' => 'http://0.0.0.0:'.getenv('PUSH_API_PORT'),
            'app_info'   => [
                getenv('PUSH_KEY') => [
                    'channel_hook' => 'http://127.0.0.1:'.getenv('SERVER_PORT').'/app/notification/push/hook',
                    'app_secret'   => getenv('PUSH_SCERET'),
                ],
            ],
        ]
    ],
];
