<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Auth;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if ($user && $user->role == User::ROLE_USER) {
            return $next($request);
        }else {
            return response()->json('Forbidden', 403);
        }
    }
}
