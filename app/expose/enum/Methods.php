<?php

namespace app\expose\enum;

use app\expose\enum\builder\Enum;

class Methods extends Enum
{
    const GET = [
        'label' => 'GET',
        'value' => 'GET'
    ];
    const POST = [
        'label' => 'POST',
        'value' => 'POST'
    ];
    const PUT = [
        'label' => 'PUT',
        'value' => 'PUT'
    ];
    const DELETE = [
        'label' => 'DELETE',
        'value' => 'DELETE'
    ];
    const OPTIONS = [
        'label' => 'OPTIONS',
        'value' => 'OPTIONS'
    ];
}
