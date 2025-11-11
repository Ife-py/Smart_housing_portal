<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('is_admin_logged_in') || !session('is_admin_logged_in')) {
            return redirect()->route('admin.login')->with('error', 'Please log in to access admin panel.');
        }
        return $next($request);
    }
}
