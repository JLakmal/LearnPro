@extends('layouts.app')

@section('content')
<h1>Student Dashboard</h1>

@foreach ($enrolledCourses as $course)
    <h2>{{ $course->title }}</h2>
    <p>{{ $course->description }}</p>

    <h3>Lessons</h3>
    <ul>
        @foreach ($course->lessons as $lesson)
            <li>
                {{ $lesson->title }}
                @if ($lesson->isCompletedBy(Auth::user()))
                    <span>Completed</span>
                @else
                    <form action="{{ route('lessons.markComplete', $lesson) }}" method="POST">
                        @csrf
                        <button type="submit">Mark as Complete</button>
                    </form>
                @endif
            </li>
        @endforeach
    </ul>
@endforeach
@endsection
