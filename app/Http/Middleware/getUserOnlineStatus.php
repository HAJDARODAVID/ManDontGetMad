<?php

namespace App\Http\Middleware;

use App\Models\UserOnlineStatus;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use function PHPUnit\Framework\isNull;

class getUserOnlineStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {  
        
        
            if($request->user()->type == 1){
                if(UserOnlineStatus::where('user_id',Auth::user()->id)){
                    UserOnlineStatus::where('user_id',Auth::user()->id)->update(['user_id' => Auth::user()->id]);
                }else{
                    UserOnlineStatus::create(['user_id' => Auth::user()->id]);
                }
            }
        
        return $next($request);
    }
}
