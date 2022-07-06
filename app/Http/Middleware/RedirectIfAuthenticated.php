<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) { 
            if (Auth::guard($guard)->check() && Auth::user()->roles == "admin") {
                return redirect()->route('admin.home');
            }elseif (Auth::guard($guard)->check() && Auth::user()->roles == "teacher") {
                return redirect()->route('teacher.home');
            }
             elseif (Auth::guard($guard)->check() && Auth::user()->roles == "student") {
                return redirect()->route('student.home');
            }
        }

        return $next($request);
    }
}
