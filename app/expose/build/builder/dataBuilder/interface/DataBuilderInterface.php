<?php

namespace app\expose\build\builder\dataBuilder\interface;

use app\expose\build\builder\dataBuilder\Basic;

interface DataBuilderInterface
{
    public function setData(mixed $data): Basic;
    public function setApi(string $api): Basic;
}
