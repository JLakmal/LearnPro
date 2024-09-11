<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Enrollment;
use App\Models\Progress; // Corrected import
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    public function index(Course $course)
    {
        $lessons = $course->lessons;
        return view('lessons.index', compact('course', 'lessons'));
    }

    public function create(Course $course)
    {
        return view('lessons.create', compact('course'));
    }

    public function store(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $course->lessons()->create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('lessons.index', $course)->with('success', 'Lesson created successfully.');
    }

    public function edit(Course $course, Lesson $lesson)
    {
        return view('lessons.edit', compact('course', 'lesson'));
    }

    public function update(Request $request, Course $course, Lesson $lesson)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $lesson->update($request->only('title', 'content'));

        return redirect()->route('lessons.index', $course)->with('success', 'Lesson updated successfully.');
    }

    public function destroy(Course $course, Lesson $lesson)
    {
        $lesson->delete();
        return redirect()->route('lessons.index', $course)->with('success', 'Lesson deleted successfully.');
    }

    public function markComplete(Request $request, Lesson $lesson)
    {
        $user = Auth::user();
        $enrollment = Enrollment::where('student_id', $user->id)
                                ->where('course_id', $lesson->course_id)
                                ->first();

        if (!$enrollment) {
            return back()->with('error', 'You are not enrolled in this course.');
        }

        $progress = Progress::firstOrCreate(
            ['enrollment_id' => $enrollment->id, 'lesson_id' => $lesson->id],
            ['is_completed' => true]
        );

        $progress->is_completed = true;
        $progress->save();

        return back()->with('success', 'Lesson marked as completed.');
    }
}
