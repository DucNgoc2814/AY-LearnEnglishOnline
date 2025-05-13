@extends('admin.layouts.app')

@section('title', $title ?? 'List')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-900">{{ $title ?? 'List' }}</h2>
        <div class="flex space-x-3">
            <a href="{{ route($route.'.index', ['trashed' => request()->get('trashed') ? 0 : 1]) }}"
               class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                <svg class="w-5 h-5 mr-2 {{ request()->get('trashed') ? 'text-green-500' : 'text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ request()->get('trashed') ? 'M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3' : 'M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16' }}" />
                </svg>
                {{ request()->get('trashed') ? 'View Active' : 'View Trash' }}
            </a>
            <a href="{{ route($route.'.create') }}"
               class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Add New
            </a>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-5">
            <form action="{{ route($route.'.index') }}" method="GET" class="space-y-4">
                <input type="hidden" name="trashed" value="{{ request()->get('trashed', 0) }}">

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <!-- Search Bar -->
                    <div class="md:col-span-2">
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input type="text" name="search" value="{{ request()->get('search') }}"
                                   class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                   placeholder="Search...">
                        </div>
                    </div>

                    <!-- Filters -->
                    @foreach($fields as $field => $options)
                        @if(isset($options['filterable']) && $options['filterable'])
                            <div>
                                <select name="filter[{{ $field }}]"
                                        class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                    <option value="">{{ $options['label'] ?? ucfirst($field) }}</option>
                                    @foreach($options['filter_options'] ?? [] as $value => $label)
                                        <option value="{{ $value }}" {{ request()->input("filter.$field") == $value ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                    @endforeach

                    <!-- Sort -->
                    <div>
                        <select name="sort"
                                class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                            <option value="">Sort By</option>
                            @foreach($fields as $field => $options)
                                @if(!isset($options['sortable']) || $options['sortable'])
                                    <option value="{{ $field }}_asc" {{ request()->get('sort') == $field.'_asc' ? 'selected' : '' }}>
                                        {{ $options['label'] ?? ucfirst($field) }} (A-Z)
                                    </option>
                                    <option value="{{ $field }}_desc" {{ request()->get('sort') == $field.'_desc' ? 'selected' : '' }}>
                                        {{ $options['label'] ?? ucfirst($field) }} (Z-A)
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="flex justify-between items-center pt-4">
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                        Apply Filters
                    </button>

                    @if(request()->has('search') || request()->has('filter') || request()->has('sort'))
                        <a href="{{ route($route.'.index', ['trashed' => request()->get('trashed', 0)]) }}"
                           class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                            <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Clear Filters
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        @foreach($fields as $field => $options)
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ $options['label'] ?? ucfirst($field) }}
                            </th>
                        @endforeach
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($items as $item)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            @foreach($fields as $field => $options)
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                    @if(isset($options['type']) && $options['type'] == 'file')
                                        @php
                                            $mediaUrl = $item->getMediaUrl($field);
                                            $extension = pathinfo($item->$field ?? '', PATHINFO_EXTENSION);
                                            $fileType = '';

                                            if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif'])) {
                                                $fileType = 'image';
                                            } elseif (in_array(strtolower($extension), ['mp4', 'mov', 'avi'])) {
                                                $fileType = 'video';
                                            } elseif (in_array(strtolower($extension), ['mp3', 'wav'])) {
                                                $fileType = 'audio';
                                            }
                                        @endphp

                                        @if($mediaUrl)
                                            <div class="relative group flex justify-center">
                                                @if($fileType == 'image')
                                                    <div class="h-16 w-16 rounded-lg overflow-hidden shadow-sm border border-gray-200">
                                                        <img src="{{ $mediaUrl }}" alt="{{ basename($item->$field) }}"
                                                             class="h-full w-full object-cover transform group-hover:scale-110 transition-transform duration-200">
                                                    </div>
                                                @elseif($fileType == 'video')
                                                    <div class="h-16 w-16 bg-blue-50 rounded-lg flex items-center justify-center group-hover:bg-blue-100 transition-colors duration-200 shadow-sm border border-gray-200">
                                                        <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                  d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                  d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                        </svg>
                                                    </div>
                                                @elseif($fileType == 'audio')
                                                    <div class="h-16 w-16 bg-green-50 rounded-lg flex items-center justify-center group-hover:bg-green-100 transition-colors duration-200 shadow-sm border border-gray-200">
                                                        <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                  d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/>
                                                        </svg>
                                                    </div>
                                                @endif

                                                <!-- Preview/Download Overlay -->
                                                <div class="opacity-0 group-hover:opacity-100 absolute inset-0 bg-black bg-opacity-50 rounded-lg flex items-center justify-center space-x-2 transition-opacity duration-200">
                                                    @if($fileType == 'image')
                                                        <a href="{{ $mediaUrl }}" target="_blank"
                                                           class="p-1.5 rounded-full bg-white text-gray-700 hover:text-blue-500 transition-colors duration-200 tooltip"
                                                           data-tooltip="Preview">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                            </svg>
                                                        </a>
                                                    @elseif($fileType == 'video')
                                                        <a href="{{ $mediaUrl }}" target="_blank"
                                                           class="p-1.5 rounded-full bg-white text-gray-700 hover:text-blue-500 transition-colors duration-200 tooltip"
                                                           data-tooltip="Play Video">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                      d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                                            </svg>
                                                        </a>
                                                    @elseif($fileType == 'audio')
                                                        <a href="{{ $mediaUrl }}" target="_blank"
                                                           class="p-1.5 rounded-full bg-white text-gray-700 hover:text-green-500 transition-colors duration-200 tooltip"
                                                           data-tooltip="Play Audio">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                      d="M9 19V6l12-3v13"/>
                                                            </svg>
                                                        </a>
                                                    @endif

                                                    <a href="{{ $mediaUrl }}" download="{{ basename($item->$field) }}"
                                                       class="p-1.5 rounded-full bg-white text-gray-700 hover:text-green-500 transition-colors duration-200 tooltip"
                                                       data-tooltip="Download">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                  d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        @else
                                            <span class="inline-flex items-center justify-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                No file
                                            </span>
                                        @endif
                                    @else
                                        <span class="flex justify-center">{{ $item->$field }}</span>
                                    @endif
                                </td>
                            @endforeach
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route($route.'.edit', $item->id) }}"
                                       class="text-indigo-600 hover:text-indigo-900 p-1.5 hover:bg-indigo-50 rounded-full transition-colors duration-200"
                                       title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <form action="{{ route($route.'.destroy', $item->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-red-600 hover:text-red-900 p-1.5 hover:bg-red-50 rounded-full transition-colors duration-200"
                                                title="Move to Trash"
                                                onclick="return confirm('Are you sure you want to move this item to trash?')">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ count($fields) + 1 }}" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                No items found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($items->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                <div class="flex items-center justify-between">
                    <!-- Pagination Info -->
                    <div class="text-sm text-gray-700">
                        Showing {{ $items->firstItem() }} to {{ $items->lastItem() }} of {{ $items->total() }} results
                    </div>

                    <!-- Pagination Links -->
                    <div class="flex items-center space-x-2">
                        {{-- Previous Page Link --}}
                        @if ($items->onFirstPage())
                            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-not-allowed rounded-md">
                                Previous
                            </span>
                        @else
                            <a href="{{ $items->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                                Previous
                            </a>
                        @endif

                        {{-- Pagination Elements --}}
                        <div class="hidden md:flex items-center space-x-2">
                            {{-- First Page --}}
                            @if($items->currentPage() > 1)
                                <a href="{{ $items->url(1) }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                                    1
                                </a>
                            @endif

                            {{-- Ellipsis for pages before current page --}}
                            @if($items->currentPage() > 3)
                                <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md">
                                    ...
                                </span>
                            @endif

                            {{-- Pages around current page --}}
                            @foreach(range(max(2, $items->currentPage() - 1), min($items->lastPage() - 1, $items->currentPage() + 1)) as $page)
                                @if($page > 1 && $page < $items->lastPage())
                                    @if ($page == $items->currentPage())
                                        <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-blue-600 rounded-md">
                                            {{ $page }}
                                        </span>
                                    @else
                                        <a href="{{ $items->url($page) }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                                            {{ $page }}
                                        </a>
                                    @endif
                                @endif
                            @endforeach

                            {{-- Ellipsis for pages after current page --}}
                            @if($items->currentPage() < $items->lastPage() - 2)
                                <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md">
                                    ...
                                </span>
                            @endif

                            {{-- Last Page --}}
                            @if($items->currentPage() < $items->lastPage())
                                <a href="{{ $items->url($items->lastPage()) }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                                    {{ $items->lastPage() }}
                                </a>
                            @endif
                        </div>

                        {{-- Next Page Link --}}
                        @if ($items->hasMorePages())
                            <a href="{{ $items->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                                Next
                            </a>
                        @else
                            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-not-allowed rounded-md">
                                Next
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
