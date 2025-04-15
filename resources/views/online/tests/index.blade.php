@extends('layouts.app')

@section('title', 'Available Tests')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="card-title mb-0 text-primary">
                <i class="fas fa-tasks me-2"></i>Available Tests
            </h5>
        </div>
        <div class="card-body">
            @if($tests->isEmpty())
                <div class="text-center py-4">
                    <div class="text-gray-500">
                        <i class="fas fa-clipboard-list fa-3x mb-3"></i>
                        <p>No tests available at the moment.</p>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($tests as $test)
                        <div class="bg-white rounded-lg shadow-sm border hover:shadow-md transition-shadow">
                            <div class="p-4">
                                <div class="flex items-center justify-between mb-3">
                                    <h3 class="text-lg font-semibold text-gray-800">{{ $test->title }}</h3>
                                    @if($test->results->isNotEmpty())
                                        <span class="badge bg-success">Completed</span>
                                    @else
                                        <span class="badge bg-primary">Available</span>
                                    @endif
                                </div>
                                
                                <div class="text-gray-600 mb-3">
                                    <p><i class="fas fa-book-reader me-2"></i>{{ $test->class->subject->name }}</p>
                                    <p><i class="fas fa-clock me-2"></i>Duration: {{ $test->duration }} minutes</p>
                                    <p><i class="fas fa-star me-2"></i>Total Points: {{ $test->total_points }}</p>
                                </div>

                                @if($test->results->isNotEmpty())
                                    <div class="mb-3">
                                        <p class="text-success">
                                            <i class="fas fa-check-circle me-1"></i>
                                            Score: {{ $test->results->first()->score }}/{{ $test->total_points }}
                                        </p>
                                    </div>
                                    <a href="{{ route('online.tests.result', ['test_id' => $test->id]) }}" 
                                       class="btn btn-outline-primary w-100">
                                        View Results
                                    </a>
                                @else
                                    <a href="{{ route('online.tests.show', ['test_id' => $test->id]) }}" 
                                       class="btn btn-primary w-100">
                                        Start Test
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

@push('styles')
<style>
    .badge {
        @apply px-2 py-1 text-xs font-semibold rounded-full;
    }
    .bg-success {
        @apply bg-green-500 text-white;
    }
    .bg-primary {
        @apply bg-blue-500 text-white;
    }
    .text-success {
        @apply text-green-600;
    }
    .btn {
        @apply px-4 py-2 rounded-lg font-medium text-center block;
    }
    .btn-primary {
        @apply bg-blue-600 text-white hover:bg-blue-700;
    }
    .btn-outline-primary {
        @apply border border-blue-600 text-blue-600 hover:bg-blue-50;
    }
    .w-100 {
        @apply w-full;
    }
</style>
@endpush 