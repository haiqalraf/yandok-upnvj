<?php
  
namespace App\Http\Middleware;
  
use Closure;
   
class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    #middleware for superuser
    public function handle($request, Closure $next)
    {
        if (auth()->check()) {
            if(auth()->user()->is_admin == 1){
                return $next($request);
            }
            return redirect('home')->with('error',"You don't have admin access.");
        }
   
        return redirect('/')->with('error',"You don't have admin access.");
    }
}