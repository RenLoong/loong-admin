<?php

$dsgcVZysogZwsgLtyLSzismIYhJiKmGtHwKNuTBOJGpColEtPdAfBpZLeEeMnqWo = [];
$cxtRRqIkAoqStnQpBEQBMFWInZDEHhUjgkHQmcwJjDMcGfHtePbWjuTEnLFLpGNk = glob(config_path('settings') . '/*.php');
foreach ($cxtRRqIkAoqStnQpBEQBMFWInZDEHhUjgkHQmcwJjDMcGfHtePbWjuTEnLFLpGNk as $path) {
    $group = basename($path, '.php');
    $dsgcVZysogZwsgLtyLSzismIYhJiKmGtHwKNuTBOJGpColEtPdAfBpZLeEeMnqWo[$group] = include $path;
}
$cxtRRqIkAoqStnQpBEQBMFWInZDEHhUjgkHQmcwJjDMcGfHtePbWjuTEnLFLpGNk = glob(base_path('plugin/*/config/settings/*.php'));
foreach ($cxtRRqIkAoqStnQpBEQBMFWInZDEHhUjgkHQmcwJjDMcGfHtePbWjuTEnLFLpGNk as $path) {
    $plugin_name = basename(dirname(dirname(dirname($path))));
    $group = basename($path, '.php');
    $dsgcVZysogZwsgLtyLSzismIYhJiKmGtHwKNuTBOJGpColEtPdAfBpZLeEeMnqWo[$plugin_name . '.' . $group] = include $path;
}
return $dsgcVZysogZwsgLtyLSzismIYhJiKmGtHwKNuTBOJGpColEtPdAfBpZLeEeMnqWo;
