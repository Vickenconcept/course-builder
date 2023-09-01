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
    public function handle(Request $request, Closure $next, $role)
    {
        $userRole = $request->user()->is_admin;
        
        if ($userRole === $role) {
            return $next($request);
        }
        
        switch ($userRole) {
            case 'super_admin':
                return $next($request);
                case 'admin':
                    return redirect()->route('course-validation.index'); // Redirect admins to the course validation index
                    case 'user':
                        
                        return redirect()->route('user-dashboard.index') ;// Redirect users to the course share page
                        default:
                return abort(403); // For any other role, return a 403 Forbidden error
        }
    }
}
