<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Student;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
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
            // Debug: Check token in session
            $token = session('jwt_token');
            if (!$token) {
                return $this->handleUnauthenticated('Vui lòng đăng nhập để tiếp tục.');
            }
            // Set token for JWTAuth
            $this->auth->setToken($token);

            // Get JWT payload
            $payload = $this->auth->getPayload();
            if (!$payload) {
                return $this->handleUnauthenticated('Token không hợp lệ.');
            }


            // Get user type and id from payload
            $userType = $payload->get('user_type');
            $userId = $payload->get('sub');

            // Get user based on type
            $user = null;
            if ($userType === 'student') {
                $user = Student::find($userId);
            } else {
                $user = Employee::find($userId);
            }

            if (!$user) {
                return $this->handleUnauthenticated('Không tìm thấy thông tin người dùng.');
            }

            // If no specific roles are required, just check authentication
            if (empty($roles)) {
                $request->attributes->add(['user' => $user, 'user_type' => $userType]);
                return $next($request);
            }

            // Check if user has any of the required roles
            $hasRole = false;

            if ($userType === 'student' && in_array('student', array_map('strtolower', $roles))) {
                $hasRole = true;
            } elseif ($userType !== 'student') {
                // For employees, check their role from the employees table
                $employeeRole = strtolower($user->role);
                if (in_array($employeeRole, array_map('strtolower', $roles))) {
                    $hasRole = true;
                }
            }


            if (!$hasRole) {
                return $this->handleUnauthorized('Bạn không có quyền truy cập vào trang này.');
            }

            // Add user and user type to request attributes
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
