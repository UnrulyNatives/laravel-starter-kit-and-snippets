<?php

namespace App\Http\Middleware;
use Closure;
use Auth;
use Redirect;
class AllowContributors {

    /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure  $next
    * @return mixed
    */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->hasRole("developer")) {
        return $next($request);
        }
        return redirect('ask_for_privilege');
        // return Redirect::back();

    }
}