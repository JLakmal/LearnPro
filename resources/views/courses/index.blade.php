@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Your Courses</h1>

    <!-- Button to Create New Course -->
    <a href="{{ route('courses.create') }}" class="btn btn-primary mb-3">Create New Course</a>

    <!-- Search Form -->
    <form action="{{ route('courses.search') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="query" class="form-control" placeholder="Search courses..." required>
            <div class="input-group-append">
                <button type="submit" class="btn btn-outline-secondary">Search</button>
            </div>
        </div>
    </form>

    <!-- List of Courses -->
    <ul class="list-group">
        @foreach($courses as $course)
            <li class="list-group-item">
                <h2>{{ $course->title }}</h2>
                <p>{{ $course->description }}</p>

                <!-- Edit Button -->
                <a href="{{ route('courses.edit', $course) }}" class="btn btn-warning btn-sm me-2">Edit</a>

                <!-- Delete Form -->
                <form action="{{ route('courses.destroy', $course) }}" method="POST" class="d-inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>

                <!-- Enroll/Unenroll Logic for Students -->
                @if(Auth::user()->role === 'student')
                    @if($course->students->contains(Auth::user()))
                        <form action="{{ route('courses.unenroll', $course) }}" method="POST" class="d-inline-block ms-2">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm">Unenroll</button>
                        </form>
                    @else
                        <form action="{{ route('courses.enroll', $course) }}" method="POST" class="d-inline-block ms-2">
                            @csrf
                            <button type="submit" class="btn btn-outline-success btn-sm">Enroll</button>
                        </form>
                    @endif
                @endif
            </li>
        @endforeach
    </ul>
</div>
@endsection
