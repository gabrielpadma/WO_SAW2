<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleBaseRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (!Auth::check()) {
            if ($request->routeIs('admin.*')) {
                return redirect('/admin/login');
            }
            // return redirect('/');
        } else {
            $role = Auth::user()->role;
            if ($role == 'admin' && !$request->routeIs('admin.*')) {
                return redirect('/admin');
            }
            if ($role == 'user' && $request->routeIs('admin.*')) {
                return redirect('/');
            }
        }

        return $next($request);
    }
}
