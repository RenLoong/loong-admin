<?php

$data = [];
$rootConfig = glob(config_path('settings-tabs') . '/*.php');
foreach ($rootConfig as $path) {
    $group = basename($path, '.php');
    $data[$group] = require $path;
}
$pluginConfig = glob(base_path('plugin/*/config/settings-tabs/*.php'));
foreach ($pluginConfig as $path) {
    $plugin_name = basename(dirname(dirname(dirname($path))));
    $group = basename($path, '.php');
    $data[$plugin_name . '.' . $group] = require $path;
}
return $data;
