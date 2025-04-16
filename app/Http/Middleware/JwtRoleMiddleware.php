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

            Log::debug('JWT Payload in middleware', [
                'payload' => $payload->toArray(),
                'token' => $token
            ]);

            // Get user type and id from payload
            $userType = $payload->get('user_type');
            $userId = $payload->get('sub');

            // Get user based on type
            $user = null;
            if ($userType === 'student') {
                $user = Student::find($userId);
            } elseif ($userType === 'employee') {
                $user = Employee::find($userId);
            }

            Log::debug('User found in middleware', [
                'user_type' => $userType,
                'user_id' => $userId,
                'user' => $user
            ]);

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

            // Convert all roles to lowercase for case-insensitive comparison
            $roles = array_map('strtolower', $roles);

            if ($userType === 'student' && in_array('student', $roles)) {
                $hasRole = true;
            } elseif ($userType === 'employee') {
                // For employees, check both the 'employee' role and specific roles
                if (in_array('employee', $roles)) {
                    $hasRole = true;
                } else {
                    // Get user roles and convert to lowercase
                    $userRoles = $user->roles->pluck('slug')->map(function($slug) {
                        return strtolower($slug);
                    })->toArray();

                    Log::debug('Checking employee roles', [
                        'required_roles' => $roles,
                        'user_roles' => $userRoles,
                        'user_id' => $userId
                    ]);

                    // Check if user has any of the required roles
                    $hasRole = !empty(array_intersect($roles, $userRoles));
                }
            }

            if (!$hasRole) {
                Log::debug('Access denied', [
                    'user_type' => $userType,
                    'required_roles' => $roles,
                    'user_roles' => $user->roles->pluck('slug')->toArray()
                ]);
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
