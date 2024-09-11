@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Lessons for {{ $course->title }}</h1>

    <a href="{{ route('lessons.create', $course) }}" class="btn btn-primary mb-3">Create New Lesson</a>

    <ul class="list-group">
        @foreach($lessons as $lesson)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $lesson->title }}

                <div>
                    <a href="{{ route('lessons.edit', [$course, $lesson]) }}" class="btn btn-sm btn-warning me-2">Edit</a>

                    <form action="{{ route('lessons.destroy', [$course, $lesson]) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
</div>
@endsection

