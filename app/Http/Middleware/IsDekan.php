<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsDekan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    #middleware for dekan admin code = 3
    public function handle($request, Closure $next)
    {
        if (auth()->check()) {
            if(auth()->user()->is_admin == 3){
                return $next($request);
            }
            return redirect('home')->with('error',"You don't have admin access.");
        }
   
        return redirect('/')->with('error',"You don't have admin access.");
    }
}
