<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckForProfile
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
        if(Auth::check() && Auth::user()->getUserType() != "admin" && Auth::user()->username_tag == $request->route('username_tag'))
        {
            return $next($request);
        }
        else
        {
            return redirect()->route('en.home.index');
        }
    }
}
