<?php

namespace App\Http\Middleware;
use Closure;
use Auth;
use Redirect;
class AllowAdmins {

    /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure  $next
    * @return mixed
    */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->hasRole("admin")) {
        return $next($request);
        }
        return redirect('login');
        // return Redirect::back();

    }
}