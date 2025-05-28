<?php

namespace app\admin\controller;

use app\Basic;
use app\expose\trait\Uploads;

class UploadsController extends Basic
{
    use Uploads;
    public function __construct()
    {
        $request = request();
        $this->admin_uid = $request->admin_uid;
    }
}
