<?php

namespace app\model;

class UserWechat extends Basic
{
    public function getNicknameAttr($value)
    {
        return base64_decode($value);
    }
    public function setNicknameAttr($value)
    {
        return base64_encode($value);
    }
}
