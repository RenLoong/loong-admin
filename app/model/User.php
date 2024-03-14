<?php

namespace app\model;

use app\expose\utils\Password;

class User extends Basic
{
    public function setPasswordAttr($value)
    {
        return Password::encrypt($value);
    }
}
