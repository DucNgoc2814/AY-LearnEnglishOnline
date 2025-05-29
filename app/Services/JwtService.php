<?php

namespace App\Services;

use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Log;

class JwtService
{
    /**
     * Generate JWT token for user
     */
    public function generateToken($user, array $customClaims = []): ?string
    {
        try {
            return JWTAuth::claims($customClaims)->fromUser($user);
        } catch (JWTException $e) {
            Log::error('Error generating JWT token', [
                'error' => $e->getMessage(),
                'user_id' => $user->id
            ]);
            return null;
        }
    }

    /**
     * Validate JWT token
     */
    public function validateToken(string $token): bool
    {
        try {
            JWTAuth::setToken($token);
            if (!JWTAuth::check()) {
                return false;
            }
            return true;
        } catch (TokenExpiredException $e) {
            return false;
        } catch (TokenInvalidException $e) {
            return false;
        } catch (JWTException $e) {
            return false;
        }
    }

    /**
     * Get user from token
     */
    public function getUserFromToken(string $token)
    {
        try {
            JWTAuth::setToken($token);
            return JWTAuth::authenticate();
        } catch (\Exception $e) {
            Log::error('Error getting user from token', [
                'error' => $e->getMessage(),
                'token' => substr($token, 0, 10) . '...'
            ]);
            return null;
        }
    }

    /**
     * Refresh JWT token
     */
    public function refreshToken(string $token): ?string
    {
        try {
            JWTAuth::setToken($token);
            return JWTAuth::refresh();
        } catch (\Exception $e) {
            Log::error('Error refreshing token', [
                'error' => $e->getMessage(),
                'token' => substr($token, 0, 10) . '...'
            ]);
            return null;
        }
    }

    /**
     * Invalidate JWT token
     */
    public function invalidateToken(string $token): bool
    {
        try {
            JWTAuth::setToken($token);
            JWTAuth::invalidate();
            return true;
        } catch (\Exception $e) {
            Log::error('Error invalidating token', [
                'error' => $e->getMessage(),
                'token' => substr($token, 0, 10) . '...'
            ]);
            return false;
        }
    }

    /**
     * Get token expiration time
     */
    public function getTokenExpiration(string $token): ?int
    {
        try {
            JWTAuth::setToken($token);
            $payload = JWTAuth::getPayload();
            return $payload->get('exp');
        } catch (\Exception $e) {
            Log::error('Error getting token expiration', [
                'error' => $e->getMessage(),
                'token' => substr($token, 0, 10) . '...'
            ]);
            return null;
        }
    }

    /**
     * Check if token needs refresh
     */
    public function needsRefresh(string $token, int $minutesThreshold = 30): bool
    {
        $expiration = $this->getTokenExpiration($token);
        if (!$expiration) {
            return true;
        }

        return ($expiration - time()) < ($minutesThreshold * 60);
    }
}
