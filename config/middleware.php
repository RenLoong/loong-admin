<?php
return [
    '' => [
        app\middleware\Template::class,
        app\middleware\Access::class,
    ],
    'control' => [
        app\control\middleware\Auth::class
    ],
    'admin' => [
        app\admin\middleware\Auth::class
    ]
];
