<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ShareEventController extends Controller
{
    public function trackShareEvent(Request $request)
    {
        $platform = $request->input('platform');
        $user = auth()->user(); 
        $courseSlug = $request->input('course_slug');
        
        $courseModel = new Course;
        
        $course = $courseModel->newQueryWithoutScopes()->where('slug', $courseSlug)->first();
        
        if ($course) {
            // $user->courses()->syncWithoutDetaching([$course->id]);
            $course->user()->sync([$user->id], false);
            
            // return redirect()->route('courses.share', ['course_slug' => $courseSlug])->with('success', 'Access granted to the course.');
            // Log::info('got here oooo');
            // return redirect()->route('courses.share', ['course_slug' => $course->slug]);
            // Log::info('Share event received for platform: ' . $platform);
        } else {
            return response('Course not found', 404);
        }
    }
}
