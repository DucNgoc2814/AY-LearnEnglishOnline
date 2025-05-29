<?php

namespace App\Http\Controllers\Online;

use App\Http\Controllers\Controller;
use App\Models\ClassStudent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassStudentController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        // Get all class registrations for the current user through the course_registration_student table
        $classStudents = ClassStudent::with(['class', 'class.teacher', 'registration'])
            ->whereHas('registration.students', function($query) use ($userId) {
                $query->where('students.id', $userId);
            })
            ->get();

        // Group classes by status
        $upcomingClasses = $classStudents->filter(function($classStudent) {
            return Carbon::parse($classStudent->start_date)->isFuture();
        })->map->class;

        $currentClasses = $classStudents->filter(function($classStudent) {
            $now = Carbon::now();
            $startDate = Carbon::parse($classStudent->start_date);
            $endDate = $classStudent->end_date ? Carbon::parse($classStudent->end_date) : null;

            return $startDate->isPast() &&
                   ($endDate === null || $endDate->isFuture()) &&
                   $classStudent->status === 'active';
        })->map->class;

        $completedClasses = $classStudents->filter(function($classStudent) {
            return $classStudent->end_date && Carbon::parse($classStudent->end_date)->isPast() ||
                   $classStudent->status === 'dropped' ||
                   $classStudent->status === 'transferred';
        })->map->class;

        return view('online.classes.index', compact('upcomingClasses', 'currentClasses', 'completedClasses'));
    }

    public function show($id)
    {
        $class = ClassStudent::with(['class', 'class.teacher', 'registration'])
            ->where('class_id', $id)
            ->whereHas('registration.students', function($query) {
                $query->where('students.id', auth()->id());
            })
            ->firstOrFail();

        return view('online.classes.show', compact('class'));
    }

    public function quiz($quiz)
    {
        // Implement quiz logic here
        return view('online.classes.quiz', compact('quiz'));
    }
}
