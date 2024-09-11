<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    public function enroll(Request $request, Course $course)
    {
        $user = Auth::user();

        if ($user->role !== 'student') {
            abort(403, 'Only students can enroll in courses.');
        }

        $course->students()->attach($user->id);

        return redirect()->route('courses.index')->with('success', 'You have been enrolled in the course.');
    }

    public function unenroll(Request $request, Course $course)
    {
        $user = Auth::user();

        if ($user->role !== 'student') {
            abort(403, 'Only students can unenroll from courses.');
        }

        $course->students()->detach($user->id);

        return redirect()->route('courses.index')->with('success', 'You have been unenrolled from the course.');
    }
}
