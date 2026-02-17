<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    //handling the two types of users
    public function handle(Request $request, Closure $next, string $userType)
    {
        if (!Auth::check() || Auth::user()->user_type !== $userType) {
            abort(403, 'Unauthorized access.');
        }
        return $next($request);
    }
}