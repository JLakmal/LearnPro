<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        // Fetch courses created by the logged-in instructor
        $courses = Course::where('instructor_id', Auth::id())->with('lessons')->get();
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $course = Course::create([
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description,
            'instructor_id' => Auth::id(),
        ]);

        return redirect()->route('courses.index')->with('success', 'Course created successfully.');
    }

    public function edit(Course $course)
    {
        if ($course->instructor_id !== Auth::id()) {
            abort(403);
        }

        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        if ($course->instructor_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $course->update($request->only(['title', 'category', 'description']));

        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        if ($course->instructor_id !== Auth::id()) {
            abort(403);
        }

        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }

    public function enroll(Course $course)
    {
        $user = Auth::user(); // Get the authenticated user

        // Enroll the user in the course
        $user->enrolledCourses()->attach($course->id);

        return back()->with('success', 'Enrolled successfully.');
    }

    public function unEnroll(Course $course)
{
    $user = Auth::user();

    // UnEnroll the user from the course
    $user->enrolledCourses()->detach($course->id);

    return back()->with('success', 'Unenrolled successfully.');
}
public function search(Request $request)
{
    $query = $request->input('query');

    $courses = Course::where('title', 'LIKE', "%{$query}%")
                     ->orWhere('description', 'LIKE', "%{$query}%")
                     ->get();

    return view('courses.index', compact('courses'));
}

}

