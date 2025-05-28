<?php

namespace app\expose\template\sms;

use app\expose\helper\ConfigGroup;
use app\expose\utils\DataModel;

class Basic extends DataModel
{
    protected $data;
    public function __construct()
    {
        $config = new ConfigGroup('sms','');
        $this->data['channels'] = $config['channels'];
        $this->data['config'] = $config[$config['channels']];
    }
}
