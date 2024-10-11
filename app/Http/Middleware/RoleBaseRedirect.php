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
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {

        // Cek apakah user sudah login

        if (!Auth::check()) {
            if ($request->routeIs('loginAdminView')) {
                return $next($request);
            }

            if ($request->is('admin/*')) {
                return redirect()->route('loginAdminView');
            }
            return redirect('/');
        } else {
            $role = Auth::user()->role;

            if ($role === 'admin' && $request->routeIs('loginAdminView')) {
                return redirect()->route('dashboard');
            }

            if ($role == 'user' && $request->is('admin/*')) {
                return redirect('/');
            }
        }

        return $next($request);
    }
}