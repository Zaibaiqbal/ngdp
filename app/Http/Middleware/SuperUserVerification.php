<?php

namespace App\Http\Middleware;

use Closure;

class SuperUserVerification
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
        if($request->user()->id == 1)
        {
            return $next($request);
        }


        return abort('403');
    }
}
