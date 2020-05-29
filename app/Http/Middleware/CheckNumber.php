<?php

namespace App\Http\Middleware;

use Closure;

class CheckNumber
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
        $user=session('res');
        if(!$user){
            return redirect('/login');
        }
        return $next($request);
    }
}
