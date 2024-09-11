@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Create Lesson for {{ $course->title }}</h1>

    <!-- Create Lesson Form -->
    <form action="{{ route('lessons.store', $course) }}" method="POST" class="needs-validation">
        @csrf

        <!-- Lesson Title Input -->
        <div class="form-group mb-3">
            <label for="title">Lesson Title</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Lesson Title" required>
        </div>

        <!-- Lesson Content Input -->
        <div class="form-group mb-4">
            <label for="content">Lesson Content</label>
            <textarea name="content" id="content" class="form-control" placeholder="Lesson Content" rows="5" required></textarea>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Create Lesson</button>
    </form>
</div>
@endsection

