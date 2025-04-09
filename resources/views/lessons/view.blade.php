@extends('layouts.app')

@section('title', 'Lesson')

@section('content')
<div id="lesson-page" 
    data-lesson-id="{{ $lessonId }}" 
    data-enrollment-id="{{ $enrollmentId }}">
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/components/video-player.css') }}">
<link rel="stylesheet" href="{{ asset('css/components/lesson-progress.css') }}">
<link rel="stylesheet" href="{{ asset('css/components/lesson-viewer.css') }}">
<link rel="stylesheet" href="{{ asset('css/pages/lesson-page.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('js/pages/LessonPage.js') }}"></script>
@endpush 