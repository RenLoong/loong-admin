<?php

namespace app\expose\build\builder\databoardBuilder\interface;

use app\expose\build\builder\databoardBuilder\Basic;

interface DataboardBuilderInterface
{
    public function setData(mixed $data): Basic;
    public function setApi(string $api): Basic;
}
