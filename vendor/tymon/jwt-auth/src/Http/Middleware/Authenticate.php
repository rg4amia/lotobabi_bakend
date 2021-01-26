<?php

/*
 * This file is part of jwt-auth.
 *
 * (c) Sean Tymon <tymon148@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tymon\JWTAuth\Http\Middleware;

use Closure;

/** @deprecated */
class Authenticate extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     *
     * @throws \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException
     *
     * @return mixed
     */
  /*  public function handle($request, Closure $next)
    {
        $this->authenticate($request);

        return $next($request);
    }*/
    public function handle($request, Closure $next)
    {
        // caching the next action
        $response = $next($request);

        try
        {
            if (! $user = JWTAuth::parseToken()->authenticate() )
            {
                return ApiHelpers::ApiResponse(101, null);
            }
        }
        catch (TokenExpiredException $e)
        {
            // If the token is expired, then it will be refreshed and added to the headers
            try
            {
                $refreshed = JWTAuth::refresh(JWTAuth::getToken());
                $response->header('Authorization', 'Bearer ' . $refreshed);
            }
            catch (JWTException $e)
            {
                return ApiHelpers::ApiResponse(103, null);
            }
            $user = JWTAuth::setToken($refreshed)->toUser();
        }
        catch (JWTException $e)
        {
            return ApiHelpers::ApiResponse(101, null);
        }

        // Login the user instance for global usage
        Auth::login($user, false);

        return $response;
    }
}
