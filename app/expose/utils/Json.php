<?php

namespace app\expose\utils;

use app\expose\enum\ResponseCode;
use support\Response;

/**
 * JSON响应工具
 */
trait Json
{
    /**
     * 返回成功JSON
     *
     * @param string $msg 消息
     * @param mixed $data 数据
     * @return Response
     */
    protected static function success($msg = 'success', $data = [])
    {
        return self::json(['code' => ResponseCode::SUCCESS, 'msg' => $msg, 'data' => $data]);
    }
    /**
     * 返回失败JSON
     *
     * @param string $msg 消息
     * @param mixed $data 数据
     * @return Response
     */
    protected static function fail(string $msg = 'fail', $data = [])
    {
        return self::json(['code' => ResponseCode::FAIL, 'msg' => $msg, 'data' => $data]);
    }
    /**
     * 返回数据JSON
     *
     * @param mixed $data 数据
     * @return Response
     */
    protected static function resData($data)
    {
        return self::json(['code' => ResponseCode::SUCCESS, 'msg' => 'success', 'data' => $data]);
    }
    protected static function event($event, $msg = 'success')
    {
        return self::code(ResponseCode::SUCCESS_EVENT_PUSH, $msg, [
            'event' => $event
        ]);
    }
    /**
     * 返回自定义JSON
     *
     * @param int $code 状态码
     * @param string $msg 消息
     * @param mixed $data 数据
     * @return Response
     */
    protected static function code($code, $msg = null, $data = [])
    {
        return self::json(['code' => $code, 'msg' => $msg, 'data' => $data]);
    }
    /**
     * 返回异常消息
     *
     * @param \Throwable $th 捕获的异常
     * @return Response
     */
    protected static function exception($th)
    {
        $data = [];
        if (config('app.debug')) {
            $data = [
                'file' => $th->getFile(),
                'line' => $th->getLine(),
                'trace' => $th->getTrace(),
            ];
        }
        return self::json(['code' => $th->getCode() ? $th->getCode() : ResponseCode::FAIL, 'msg' => $th->getMessage(), 'data' => $data]);
    }
    /**
     * 响应失败
     *
     * @param \Throwable $th 捕获的异常
     * @return Response
     */
    protected static function server($th, $http_code = 500)
    {
        return self::json(['code' => $th->getCode() ? $th->getCode() : ResponseCode::FAIL, 'msg' => $th->getMessage(), 'data' => ['file' => $th->getFile(), 'line' => $th->getLine()]], JSON_UNESCAPED_UNICODE, $http_code);
    }
    /**
     * 返回JSON
     *
     * @param mixed $data JSON数据
     * @param int|null $options JSON编码
     * @param int $http_code 服务器响应代码
     * @return Response
     */
    protected static function json($data, $options = JSON_UNESCAPED_UNICODE, $http_code = 200)
    {
        $request=request();
        if($request&&$request->lang){
            $data['msg']=trans($data['msg'],[], null, $request->lang);
        }
        return new Response($http_code, ['Content-Type' => 'application/json'], json_encode($data, $options));
    }
}
