<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRouterMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
        $name = $request->route()->getName();
        // dd($name);
        if (
            $name
            && Auth::guard('api')->check()
            && ! Auth::guard('api')->user()->can($name)
        ) {
            return response()->json(['message' => 'You don\'t have permission to do this'], 403);
        }
        return $next($request);
    }
}
