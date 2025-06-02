@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-900">Dashboard Overview</h2>
        <div class="flex space-x-3">
            <button type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                </svg>
                Export Report
            </button>
        </div>
    </div>

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Students -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Total Students</dt>
                        <dd class="flex items-baseline">
                            <div class="text-2xl font-semibold text-gray-900">1,234</div>
                            <div class="ml-2 flex items-baseline text-sm font-semibold text-green-600">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                </svg>
                                <span class="ml-0.5">12%</span>
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Active Courses -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Active Courses</dt>
                        <dd class="flex items-baseline">
                            <div class="text-2xl font-semibold text-gray-900">45</div>
                            <div class="ml-2 flex items-baseline text-sm font-semibold text-green-600">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                </svg>
                                <span class="ml-0.5">8%</span>
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Monthly Revenue -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Monthly Revenue</dt>
                        <dd class="flex items-baseline">
                            <div class="text-2xl font-semibold text-gray-900">$52,000</div>
                            <div class="ml-2 flex items-baseline text-sm font-semibold text-green-600">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                </svg>
                                <span class="ml-0.5">15%</span>
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Active Classes -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-.586-1.414l-4.5-4.5A2 2 0 0012.586 3H7" />
                    </svg>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Active Classes</dt>
                        <dd class="flex items-baseline">
                            <div class="text-2xl font-semibold text-gray-900">28</div>
                            <div class="ml-2 flex items-baseline text-sm font-semibold text-red-600">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                                </svg>
                                <span class="ml-0.5">3%</span>
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Student Enrollment Chart -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Student Enrollment Trend</h3>
            <div class="h-80 bg-gray-50 rounded-lg border border-gray-200 p-4">
                <!-- Placeholder for chart -->
                <div class="w-full h-full flex items-center justify-center text-gray-500">
                    Chart will be implemented with Chart.js or similar library
                </div>
            </div>
        </div>

        <!-- Revenue Chart -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Revenue Overview</h3>
            <div class="h-80 bg-gray-50 rounded-lg border border-gray-200 p-4">
                <!-- Placeholder for chart -->
                <div class="w-full h-full flex items-center justify-center text-gray-500">
                    Chart will be implemented with Chart.js or similar library
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Recent Activities</h3>
            <div class="flow-root">
                <ul class="-mb-8">
                    <li class="relative pb-8">
                        <div class="relative flex items-start space-x-3">
                            <div class="relative">
                                <div class="h-8 w-8 bg-blue-500 rounded-full flex items-center justify-center ring-8 ring-white">
                                    <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="min-w-0 flex-1">
                                <div>
                                    <div class="text-sm font-medium text-gray-900">
                                        New Student Registration
                                    </div>
                                    <p class="mt-0.5 text-sm text-gray-500">
                                        John Doe enrolled in Advanced English Course
                                    </p>
                                </div>
                                <div class="mt-2 text-sm text-gray-500">
                                    <time datetime="2023-01-23T13:23">3 minutes ago</time>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="relative pb-8">
                        <div class="relative flex items-start space-x-3">
                            <div class="relative">
                                <div class="h-8 w-8 bg-green-500 rounded-full flex items-center justify-center ring-8 ring-white">
                                    <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="min-w-0 flex-1">
                                <div>
                                    <div class="text-sm font-medium text-gray-900">
                                        Course Completion
                                    </div>
                                    <p class="mt-0.5 text-sm text-gray-500">
                                        Sarah Smith completed Intermediate Grammar Course
                                    </p>
                                </div>
                                <div class="mt-2 text-sm text-gray-500">
                                    <time datetime="2023-01-23T13:23">1 hour ago</time>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="relative pb-8">
                        <div class="relative flex items-start space-x-3">
                            <div class="relative">
                                <div class="h-8 w-8 bg-yellow-500 rounded-full flex items-center justify-center ring-8 ring-white">
                                    <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="min-w-0 flex-1">
                                <div>
                                    <div class="text-sm font-medium text-gray-900">
                                        Class Schedule Update
                                    </div>
                                    <p class="mt-0.5 text-sm text-gray-500">
                                        Business English class rescheduled to 3:00 PM
                                    </p>
                                </div>
                                <div class="mt-2 text-sm text-gray-500">
                                    <time datetime="2023-01-23T13:23">2 hours ago</time>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="mt-6">
                <a href="#" class="text-sm font-medium text-blue-600 hover:text-blue-500">
                    View all activities <span aria-hidden="true">&rarr;</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
