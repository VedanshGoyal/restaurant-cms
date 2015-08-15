<?php

namespace Restaurant\Http\Middleware;

use Closure;
use \Restaurant\Exceptions\NotAuthorizedException;

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
            $logData = ['role' => sprintf('%s', $role)];
            $message = 'You are not authorized to access this content.';

            throw new NotAuthorizedException($message, $logData);
        }

        return $next($request);
    }
}
