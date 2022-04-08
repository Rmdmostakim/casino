<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SuperAdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {   

        if($request->session()->has('super_admin')){
            $super_admin_password = \Request::session()->get('super_admin');
            $matched = \Hash::check(config('app.super-admin-password'),$super_admin_password);
            return $next($request);
        }
        return redirect()->route('superadmin.login');
    }
}
