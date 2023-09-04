<?php

namespace App\Http\Middleware;

use App\Models\CourseIpAddress;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogIpAddress
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ipAddress = $request->ip();
        
        $courseId = $request->route()->parameters()['courseId'];
        // dd($courseSlug = $request->route()->parameters());
        CourseIpAddress::create([
            'course_id' => $courseId,
            'ip_address' => $ipAddress,
        ]);
        
        return $next($request);
    }
}
