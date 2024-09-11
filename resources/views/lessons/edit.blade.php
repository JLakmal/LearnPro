@extends('layouts.app')

@section('content')
<h1>Edit Lesson for {{ $course->title }}</h1>

<form action="{{ route('lessons.update', [$course, $lesson]) }}" method="POST">
    @csrf
    @method('PUT')
    <input type="text" name="title" value="{{ old('title', $lesson->title) }}" required>
    <textarea name="content" required>{{ old('content', $lesson->content) }}</textarea>
    <button type="submit">Update Lesson</button>
</form>
@endsection
