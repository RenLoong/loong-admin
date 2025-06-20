<?php
$enable=file_exists(base_path('plugin/notification'));
$d=[
    'enable'       => $enable,
    'websocket'    => 'websocket://0.0.0.0:'.getenv('PUSH_WSS_PORT'),
    'api'          => 'http://0.0.0.0:'.getenv('PUSH_API_PORT'),
    'app_key'      => getenv('PUSH_KEY'),
    'app_secret'   => getenv('PUSH_SCERET'),
    'channel_hook' => 'http://127.0.0.1:'.getenv('SERVER_PORT').'/plugin/webman/push/hook',
    'auth'         => '/plugin/webman/push/auth'
];
return $d;