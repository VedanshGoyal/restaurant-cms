<?php

namespace Restaurant\Http\Middleware;

use Closure;
use Tymon\JWTAuth\JWTAuth;

class UserFromTokenMiddleware
{
    /**
     * Initialize a new instance
     *
     * @param JWTAuth $jwtAuth
     */
    public function __construct(JWTAuth $jwtAuth)
    {
        $this->jwt = $jwtAuth;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->headers->has('Authorization')) {
            $request->user = $this->jwt->parseToken()->authenticate();
        }

        return $next($request);
    }
}
