<?php

namespace App\Http\Controllers\Online;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\TestResult;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    /**
     * Display a listing of available tests.
     */
    public function index()
    {
        $student = Auth::user();
        $tests = Test::query()
            ->with(['results' => function($query) use ($student) {
                $query->where('student_id', $student->id);
            }])
            ->whereHas('class.students', function($query) use ($student) {
                $query->where('student_id', $student->id);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('online.tests.index', compact('tests'));
    }

    /**
     * Display a test.
     */
    public function show($test_id)
    {
        $test = Test::findOrFail($test_id);
        return view('online.tests.show', compact('test'));
    }

    /**
     * Submit a test.
     */
    public function submit(Request $request, $test_id)
    {
        $test = Test::findOrFail($test_id);
        
        // Validate the submission
        $validated = $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required'
        ]);

        // Create test result
        $result = TestResult::create([
            'test_id' => $test_id,
            'student_id' => Auth::id(),
            'answers' => $validated['answers'],
            'score' => 0, // Will be calculated
            'submitted_at' => now()
        ]);

        // Calculate score (implement your scoring logic here)
        $score = $this->calculateScore($test, $validated['answers']);
        $result->update(['score' => $score]);

        return redirect()->route('online.tests.result', ['test_id' => $test_id]);
    }

    /**
     * Show test result.
     */
    public function result($test_id)
    {
        $test = Test::with(['results' => function($query) {
            $query->where('student_id', Auth::id())
                  ->latest('submitted_at')
                  ->first();
        }])->findOrFail($test_id);

        return view('online.tests.result', compact('test'));
    }

    /**
     * Calculate test score.
     */
    private function calculateScore($test, $answers)
    {
        // Implement your scoring logic here
        // This is just a placeholder
        return 0;
    }
} 