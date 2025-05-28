<?php

namespace app\expose\template\sms;

class Vcode extends Basic
{
    public function builder()
    {
        $this->data['templateCode'] = $this->config['vcode_template_code'];
    }
}
