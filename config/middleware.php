<?php
return [
    '' => [
        app\middleware\Template::class,
        app\middleware\Access::class,
    ],
    'admin' => [
        app\admin\middleware\Auth::class
    ]
];
