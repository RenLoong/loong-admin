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
function arrayToXml($data, $root = 'xml')
{
    $xml = "<{$root}>";
    foreach ($data as $key => $value) {
        if (is_array($value)) {
            $xml .= arrayToXml($value, $key);
        } else {
            $xml .= "<{$key}>{$value}</{$key}>";
        }
    }
    $xml .= "</{$root}>";
    return $xml;
}