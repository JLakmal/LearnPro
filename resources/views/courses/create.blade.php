@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">{{ isset($course) ? 'Edit Course' : 'Create Course' }}</h1>

    <!-- Course Form -->
    <form action="{{ isset($course) ? route('courses.update', $course) : route('courses.store') }}" method="POST" class="needs-validation">
        @csrf
        @if(isset($course))
            @method('PUT')
        @endif

        <!-- Course Title Input -->
        <div class="form-group mb-3">
            <label for="title">Course Title</label>
            <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $course->title ?? '') }}" placeholder="Course Title" required>
        </div>

        <!-- Course Category Input -->
        <div class="form-group mb-3">
            <label for="category">Course Category</label>
            <input type="text" id="category" name="category" class="form-control" value="{{ old('category', $course->category ?? '') }}" placeholder="Course Category" required>
        </div>

        <!-- Course Description Input -->
        <div class="form-group mb-4">
            <label for="description">Course Description</label>
            <textarea id="description" name="description" class="form-control" placeholder="Course Description" rows="4" required>{{ old('description', $course->description ?? '') }}</textarea>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">{{ isset($course) ? 'Update' : 'Create' }} Course</button>
    </form>
</div>
@endsection
