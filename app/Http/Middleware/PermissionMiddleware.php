<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;
use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Traits\HasRoles;

class PermissionMiddleware
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
        // if(!Auth::user()->can('edit')){
        //     dd('123');
        // }
        // dd('321');
        // return $next($request);
    }
}
