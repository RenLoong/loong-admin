<?php

namespace app\control\controller;

use app\Basic;
use app\expose\trait\Uploads;

class UploadsController extends Basic
{
    use Uploads;
    public function __construct()
    {
        $request = request();
        $this->uid = $request->uid;
    }
}
