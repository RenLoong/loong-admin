<?php

namespace app\expose\template\email;

use app\expose\utils\DataModel;

class Vcode extends DataModel
{
    public function builder($username)
    {
        return "您的验证码是：1234";
    }
}
