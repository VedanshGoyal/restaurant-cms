<?php

namespace Restaurant\Http\Middleware;

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
        if (!$request->user || !$request->user->hasRole($role)) {
            $logData = ['role' => sprintf('%s', $role)];
            $message = 'The user account provided does not have the ' .
                'correct privileges to access the requested content.';

            throw new \Restaurant\Exceptions\NotAuthorizedException($message, $logData);
        }

        return $next($request);
    }
}
