<?php

namespace app\expose\middleware;

use app\expose\enum\ResponseCode;
use app\expose\helper\Config;
use app\expose\utils\Json;
use Exception;
use loong\oauth\exception\LockException;
use loong\oauth\exception\TokenExpireException;
use Webman\MiddlewareInterface;
use Webman\Http\Response;
use Webman\Http\Request;
use loong\oauth\facade\Auth;

/**
 * 中台应用必须继承此中间件，否者无法正常访问
 */
class ControlAuth implements MiddlewareInterface
{
    use Json;
    public function process(Request $request, callable $next): Response
    {
        if ($request->method() == 'OPTIONS') {
            return response('', 204);
        }
        // 鉴权检测
        try {
            $control_config = Config::get('control');
            if(!$control_config['state']){
                throw new Exception(trans('Control Not Open', [], $request->app, $request->lang), ResponseCode::FAIL);
            }
            $this->Icode($request);
            $this->Authorization($request);
            $response = $next($request);
        } catch (\Throwable $th) {
            if ($request->expectsJson()) {
                $response = $this->exception($th);
            } else {
                if(config('app.debug')){
                    throw $th;
                }else{
                    $response = response($th->getMessage(), 500);
                }
            }
        }
        return $response;
    }
    public function Icode(Request $request)
    {
        $icode = $request->header('x-icode');
        if (!$icode) {
            return true;
        }
        $request->icode = $icode;
    }

    /**
     * 业务逻辑
     * @author 贵州猿创科技有限公司
     * @Email 416716328@qq.com
     * @DateTime 2023-03-11
     */
    public function Authorization(Request $request)
    {
        # 无控制器地址
        if (!$request->controller) {
            return true;
        }
        # 获取控制器鉴权信息
        $controller = new \ReflectionClass($request->controller);
        $properties = $controller->getDefaultProperties();
        # 无需登录方法
        $notNeedLogin = $properties['notNeedLogin'] ?? [];
        # 是否强制登录
        $isForceLogin = true;
        if (in_array($request->action, $notNeedLogin)) {
            $isForceLogin = false;
        }
        try {
            # 令牌验证
            $token = $request->header('Authorization');
            if (!$token) {
                throw new Exception('请先登录', ResponseCode::NEED_LOGIN);
            }
            $user = Auth::setPrefix('CONTROL')->decrypt($token);
            if (!$user) {
                throw new TokenExpireException();
            }
            $request->uid           = $user['uid'];
            $request->token         = $token;
        } catch (TokenExpireException $e) {
            if ($isForceLogin) {
                throw new Exception('登录已过期，请重新登录', ResponseCode::NEED_LOGIN);
            }
        } catch (LockException $e) {
            if ($isForceLogin) {
                throw new Exception($e->getMessage(), ResponseCode::LOCK);
            }
        } catch (\Throwable $th) {
            if ($isForceLogin) {
                throw new \Exception($th->getMessage(), ResponseCode::NEED_LOGIN);
            }
        }
    }
}
