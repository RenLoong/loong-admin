<?php

namespace app\expose\middleware;

use app\expose\enum\ResponseCode;
use app\expose\utils\Json;
use Exception;
use Webman\MiddlewareInterface;
use Webman\Http\Response;
use Webman\Http\Request;
use loong\oauth\facade\Auth;

/**
 * 后台应用必须继承此中间件，否者无法正常访问
 */
class AdminAuth implements MiddlewareInterface
{
    use Json;
    public function process(Request $request, callable $next): Response
    {
        if ($request->method() == 'OPTIONS') {
            return response('', 204);
        }
        # 微信浏览器
        $this->isWehcatBrowser($request);
        // 鉴权检测
        try {
            $this->canAccess($request);
            $response = $next($request);
        } catch (\Throwable $th) {
            if ($request->isAjax()) {
                $response = $this->exception($th);
            } else {
                throw $th;
            }
        }
        return $response;
    }
    public function isWehcatBrowser($request)
    {
        $request->isWehcatBrowser = strpos(strtolower($request->header('user-agent')), 'micromessenger') !== false;
    }

    /**
     * 业务逻辑
     * @author 贵州猿创科技有限公司
     * @Email 416716328@qq.com
     * @DateTime 2023-03-11
     */
    public function canAccess(Request $request): bool
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
        # 无需鉴权方法
        $notNeedAuth = $properties['notNeedAuth'] ?? [];
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
            $user = Auth::setPrefix('ADMIN')->decrypt($token);
            if (!$user) {
                throw new Exception('登录已过期，请重新登录', ResponseCode::NEED_LOGIN);
            }
            $request->admin_uid           = $user['uid'];
        } catch (\Throwable $th) {
            if ($isForceLogin) {
                throw new \Exception($th->getMessage(), ResponseCode::NEED_LOGIN);
            }
        }
        if ($request->admin_uid) {
            if ($user['is_system']) {
                return true;
            } else {
                $now = date('H:i:s');
                if (!($now >= $user['allow_time_start'] && $now <= $user['allow_time_end'])) {
                    throw new Exception("当前不在工作时间");
                }
                if (!in_array(date('w'), $user['allow_week'])) {
                    throw new Exception("今日因该是休息日哦");
                }
            }
        }
        # 不需要鉴权
        if (in_array($request->action, $notNeedAuth)) {
            return true;
        }
        return true;
    }
}
