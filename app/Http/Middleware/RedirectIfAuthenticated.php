<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if(Auth::user()->hasRole('administrator'))
                {
                    return redirect()->route('/administrator');
                }elseif(Auth::user()->hasRole('office'))
                {
                    return redirect()->route('/office');
                }elseif(Auth::user()->hasRole('student'))
                {
                    return redirect()->route('/student');
                }elseif(Auth::user()->hasRole('director'))
                {
                    return redirect()->route('/director');
                }elseif(Auth::user()->hasRole('office_titular'))
                {
                    return redirect()->route('/office/titular');
                }elseif(Auth::user()->hasRole('professor'))
                {
                    return redirect()->route('/professor');
                }

            }
        }

        return $next($request);
    }
}
