<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next ): Response
    {
        $queryparams= $request->all();
        //dd($queryparams['test']);
       if(isset($queryparams['test']) && $queryparams['test'] === "yes")
        {
            return $next($request);
        }
        else{
            return response()->json([
                'status' => false,
                'message' => 'unauthenticate user',
                'data' => []
            ],400);
        }
    }
}
