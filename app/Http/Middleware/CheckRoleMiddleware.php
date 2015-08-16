<?php

namespace Restaurant\Http\Middleware;

use Illuminate\Contracts\Validation\UnauthorizedException;
use Illuminate\Http\JsonResponse;
use Closure;

class CheckRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if ($request->user && $request->user->hasRole($role)) {
            return $next($request);
        }

        return new JsonResponse('Not Authorized', 403);
    }
}
