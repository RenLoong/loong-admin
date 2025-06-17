<?php
include_once(__DIR__ . '/../../../vendor/autoload.php');

use Volc\Service\ImageX;

$client = ImageX::getInstance();

// call below method if you dont set ak and sk in ～/.volc/config
$client->setAccessKey("ak");
$client->setSecretKey("sk");

$args = ['ServiceId' => "",
    'TaskType' => 'block_url',
    'StartTime' => 0,
    'EndTime' => 2147483647,
];

$resp = $client->getImageContentTaskDetail($args);
print_r($resp);
