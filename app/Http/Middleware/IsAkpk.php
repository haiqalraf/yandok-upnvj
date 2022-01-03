<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAkpk
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    #middleware for akpk, admin code = 2
    public function handle($request, Closure $next)
    {
        if (auth()->check()) {
            if(auth()->user()->is_admin == 2){
                return $next($request);
            }
            return redirect('home')->with('error',"You don't have admin access.");
        }
   
        return redirect('/')->with('error',"You don't have admin access.");
    }
}
