<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUnactiveUser
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
        if(Auth::check()){

            if(Auth::user()->ban)
                return redirect()->route('members.show.ban', Auth::user()->id);

            if(!Auth::user()->visible)
                return redirect()->route('members.show.activate', Auth::user()->id);

        }

        return $next($request);
    }
}

