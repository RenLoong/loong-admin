<?php

namespace app\exception;

use app\expose\trait\Json;
use Throwable;
use Webman\Exception\ExceptionHandler;
use Webman\Http\Request;
use Webman\Http\Response;

class Handler extends ExceptionHandler
{
    use Json;
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    public function render(Request $request, Throwable $exception): Response
    {
        if ($request->expectsJson()) {
            return $this->exception($exception);
        }
        if (config('app.debug')) {
            return parent::render($request, $exception);
        }
        return new Response(500, [], $exception->getMessage());
    }
}
