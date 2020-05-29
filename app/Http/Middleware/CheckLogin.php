<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogin
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
        $res=session('res');
        if(!$res){
            $cookie_admin=request()->cookie('res');
            if($cookie_admin){
                session(['admin'=>unserialize($cookie_admin)]);
            }else{
                return redirect('/');
            }
        }
        
        return $next($request);
    }
}
