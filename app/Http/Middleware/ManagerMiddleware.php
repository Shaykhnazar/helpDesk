<?php

namespace App\Http\Middleware;
use Closure;
use App\User;
use Auth;
class ManagerMiddleware
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
        if ($user && $user->role == User::ROLE_MANAGER) {
            return $next($request);
        }/* else if($request->input('email')){
            return redirect()->route('login')->with($request->input('email'));
        } */else {
            return response()->json('Forbidden', 403);
        }
    }
}
