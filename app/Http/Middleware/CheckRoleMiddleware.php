<?php

namespace Restaurant\Http\Middleware;

use Closure;
use Illuminate\Contracts\Validation\UnauthorizedException;

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
        if (!$request->user || !$request->user->hasRole($role)) {
            throw new UnauthorizedException('You are not authorized to access this content.');
        }

        return $next($request);
    }
}
