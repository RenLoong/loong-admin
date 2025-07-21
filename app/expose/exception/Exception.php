<?php

namespace app\expose\exception;

class Exception extends \Exception
{
    protected $data = [];

    public function __construct($message = '', $code = 0, $data = [])
    {
        parent::__construct($message, $code);
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }
}