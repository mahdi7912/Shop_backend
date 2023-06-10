<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role, $premission = null)
    {

        if(!$request->user()->hasRole($role) && $premission == null){
            return response()->json([
                'message' => "forbidden"
            ], 403);
        }
        if($premission !== null &&  !$request->user()->can($premission) ){
            return response()->json([
                'message' => "forbidden"
            ], 403);
        }
        return $next($request);
    }
}
