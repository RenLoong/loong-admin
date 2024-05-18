<?php

$THdgztKTYJsWLLXZcXQMGIuHfRryJoAqKEGVReirMgDnJIxhUwHDVjClOKKcXKSD = [];
$GhegubjlWqkgItXJzzWLDAzbHcpbVXshbBaQUQkOvJmzcCkvKXSmNcfITiRoNRrE = glob(config_path('settings-tabs') . '/*.php');
foreach ($GhegubjlWqkgItXJzzWLDAzbHcpbVXshbBaQUQkOvJmzcCkvKXSmNcfITiRoNRrE as $path) {
    $group = basename($path, '.php');
    $THdgztKTYJsWLLXZcXQMGIuHfRryJoAqKEGVReirMgDnJIxhUwHDVjClOKKcXKSD[$group] = require $path;
}
$GhegubjlWqkgItXJzzWLDAzbHcpbVXshbBaQUQkOvJmzcCkvKXSmNcfITiRoNRrE = glob(base_path('plugin/*/config/settings-tabs/*.php'));
foreach ($GhegubjlWqkgItXJzzWLDAzbHcpbVXshbBaQUQkOvJmzcCkvKXSmNcfITiRoNRrE as $path) {
    $plugin_name = basename(dirname(dirname(dirname($path))));
    $group = basename($path, '.php');
    $THdgztKTYJsWLLXZcXQMGIuHfRryJoAqKEGVReirMgDnJIxhUwHDVjClOKKcXKSD[$plugin_name . '.' . $group] = require $path;
}
return $THdgztKTYJsWLLXZcXQMGIuHfRryJoAqKEGVReirMgDnJIxhUwHDVjClOKKcXKSD;
