<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RestrictUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->is_admin === 'super_admin') {
            // Admin access
            return $next($request);
        } elseif ($request->user()->is_admin === 'admin') {
       
            // Admin access
            return $next($request);
        } elseif ($request->user()->is_admin === 'user') {
            return redirect()->route('user-dashboard.index'); // Or any other default page

        }
    }
}
