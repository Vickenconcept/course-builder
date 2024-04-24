<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseIpAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ShareEventController extends Controller
{
   

   

    public function trackShareEvent(Request $request)
    {
        $platform = $request->input('platform');
        $courseSlug = $request->input('course_slug');
        $courseId = $request->input('courseId');
        $ipAddress = $request->ip();
        Log::info('Share event received for platform: ' . $platform);

        // Find the course based on the course slug
        $courseModel = new Course;
        $course = $courseModel->newQueryWithoutScopes()->where('slug', $courseSlug)->first();

        if ($course) {
            // Check if there is an IP address record for this course
            $ipRecord = CourseIpAddress::where('course_id', $courseId)
                ->where('ip_address', $ipAddress)
                ->first();

            if (!$ipRecord) {
                // If there is no IP record for this course and IP address, create one
                CourseIpAddress::create([
                    'course_id' => $course->id,
                    'ip_address' => $ipAddress,
                ]);
            }
            $course->user()->sync([$user->id], false);

            // Redirect the user to the share route or perform any other desired action
            // For example:
            // return redirect()->route('courses.share', ['course_slug' => $courseSlug])->with('success', 'Access granted to the course.');

            // Log the share event
            // Log::info('Share event received for platform: ' . $platform);
        } else {
            return response('Course not found', 404);
        }
    }
}
