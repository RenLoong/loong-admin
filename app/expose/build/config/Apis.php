<?php

namespace app\expose\build\config;

use app\expose\utils\DataModel;

class Apis extends DataModel
{
    protected $data = [
        'userinfo' => 'User/getUserInfo',
    ];
    public function __construct(array $data = [])
    {
        $this->data = array_merge($this->data, $data);
    }
}
