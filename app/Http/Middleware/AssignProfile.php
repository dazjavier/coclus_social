<?php

namespace Coclus\Http\Middleware;

use Auth;
use Closure;

class AssignProfile
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
        if (Auth::user()->has_profile_set == 0) {
            return redirect()->to('/set_profile');
        }

        return $next($request);
    }
}
