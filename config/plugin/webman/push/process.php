<?php
use Webman\Push\Server;
return [
    'server' => [
        'handler' => Server::class,
        'listen' => 'websocket://0.0.0.0:'.getenv('PUSH_WSS_PORT'),
        'count' => 1,
        'constructor' => [
            'api_listen' => 'http://0.0.0.0:'.getenv('PUSH_API_PORT'),
            'app_info'   => [
                getenv('PUSH_KEY') => [
                    'channel_hook' => 'http://127.0.0.1:'.getenv('SERVER_PORT').'/plugin/webman/push/hook',
                    'app_secret'   => getenv('PUSH_SCERET'),
                ],
            ],
        ]
    ],
];
