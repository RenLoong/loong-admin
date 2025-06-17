<?php

namespace app\expose\middleware;

use app\expose\enum\ResponseCode;
use app\expose\enum\State;
use app\expose\utils\Json;
use app\model\Admin;
use Exception;
use loong\oauth\exception\LockException;
use loong\oauth\exception\TokenExpireException;
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
    public function isWehcatBrowser($request)
    {
        $request->isWehcatBrowser = strpos(strtolower($request->header('user-agent')??''), 'micromessenger') !== false;
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
                throw new TokenExpireException();
            }
            $request->admin_uid           = $user['uid'];
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
                $Admin = Admin::where('id', $user['uid'])->find();
                if ($Admin->state != State::YES['value']) {
                    throw new Exception("您的账号已被禁用", ResponseCode::NEED_LOGIN);
                }
            }
        }
        # 不需要鉴权
        if (in_array($request->action, $notNeedAuth)) {
            return true;
        }
        if (empty($user)) {
            throw new Exception('请先登录', ResponseCode::NEED_LOGIN);
        }
        if (empty($user['permissions'])) {
            throw new Exception('您没有权限访问', ResponseCode::NO_PERMISSION);
        }
        $plugin = $request->plugin;
        // plugin\api\app\admin\controller\IndexController,只取Index
        $controllers = explode('\\', $request->controller);
        $controller = str_replace('Controller', '', end($controllers));
        $action = str_replace('GetTable', '', $request->action);
        $rule = $controller . '/' . $action;
        if ($plugin) {
            $app = $request->app;
            $rule = "/app/{$plugin}/{$app}/{$rule}";
        }
        if (!in_array($rule, $user['permissions'])) {
            throw new Exception('您没有权限访问', ResponseCode::NO_PERMISSION);
        }
    }
}
