<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

use function PHPUnit\Framework\isNull;

class checkIfGameboard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {  

        if(!isNull(Auth::user())){
            if(Auth::user()->type == 0){
                return $next($request);
                
            }else{
                return redirect(route('home'));
            }
        }

        return $next($request);         
    }
}
