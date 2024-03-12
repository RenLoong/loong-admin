<?php
function p()
{
    $argv = func_get_args();
    if (count($argv) == 1) {
        $data = $argv[0];
    } else {
        $data = $argv;
    }
    echo "<pre>";
    print_r($data);
    echo '</pre>';
}
