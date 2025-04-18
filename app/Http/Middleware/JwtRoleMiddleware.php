<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Student;
use App\Models\Employee;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;

class JwtRoleMiddleware extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        try {
            $token = session('jwt_token');
            if (!$token) {
                return $this->handleUnauthenticated('Vui lòng đăng nhập để tiếp tục.');
            }

            $this->auth->setToken($token);

            $payload = $this->auth->getPayload();
            if (!$payload) {
                return $this->handleUnauthenticated('Token không hợp lệ.');
            }

            $userType = $payload->get('user_type');
            $userId = $payload->get('sub');

            $user = null;
            if ($userType === 'student') {
                $user = Student::find($userId);
            } elseif ($userType === 'employee') {
                $user = Employee::find($userId);
            }

            if (!$user) {
                return $this->handleUnauthenticated('Không tìm thấy thông tin người dùng.');
            }

            if (empty($roles)) {
                $request->attributes->add(['user' => $user, 'user_type' => $userType]);
                return $next($request);
            }

            $hasRole = false;
            
            $roles = array_map('strtolower', $roles);

            if ($userType === 'student') {
                $hasRole = in_array('student', $roles);
            } elseif ($userType === 'employee') {
                $hasRole = in_array(strtolower($user->role), $roles);
            }

            if (!$hasRole) {
                return $this->handleUnauthorized('Bạn không có quyền truy cập vào trang này.');
            }

            $request->attributes->add([
                'user' => $user,
                'user_type' => $userType
            ]);

            return $next($request);
        } catch (TokenExpiredException $e) {
            return $this->handleUnauthenticated('Phiên đăng nhập đã hết hạn. Vui lòng đăng nhập lại.');
        } catch (TokenInvalidException $e) {
            return $this->handleUnauthenticated('Phiên đăng nhập không hợp lệ. Vui lòng đăng nhập lại.');
        } catch (JWTException $e) {
            return $this->handleUnauthenticated('Có lỗi xảy ra với phiên đăng nhập. Vui lòng đăng nhập lại.');
        } catch (\Exception $e) {
            return $this->handleUnauthenticated('Có lỗi xảy ra. Vui lòng thử lại sau.');
        }
    }

    /**
     * Handle unauthenticated users
     *
     * @param string $message
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function handleUnauthenticated(string $message)
    {
        session()->flush();
        return redirect()->route('online.login')
            ->with('notification', [
                'message' => $message,
                'type' => 'error'
            ]);
    }

    /**
     * Handle unauthorized access
     *
     * @param string $message
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function handleUnauthorized(string $message)
    {
        return redirect()->back()
            ->with('notification', [
                'message' => $message,
                'type' => 'error'
            ]);
    }
}
