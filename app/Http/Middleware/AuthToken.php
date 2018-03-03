<?php

namespace App\Http\Middleware;

use Closure;

class AuthToken
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
      
        $auth = $request->header('Authorization');
        
        if($auth){
        	return $next($request);
        }
        
        return response()->json(["error" => "Tente nvomante! Estamos com problemas entre em contato com a SmartClick."], 403);
    }
}
