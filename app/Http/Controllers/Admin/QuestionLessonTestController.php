<?php

namespace App\Http\Controllers;

use App\Models\QuestionLessonTest;
use Illuminate\Http\Request;

class QuestionLessonTestController extends Controller
{
    public function index()
    {
        return QuestionLessonTest::all();
    }

    public function store(Request $request)
    {
        $questionLessonTest = QuestionLessonTest::create($request->all());
        return response()->json($questionLessonTest, 201);
    }

    public function show($id)
    {
        return QuestionLessonTest::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $questionLessonTest = QuestionLessonTest::findOrFail($id);
        $questionLessonTest->update($request->all());
        return response()->json($questionLessonTest, 200);
    }

    public function destroy($id)
    {
        QuestionLessonTest::destroy($id);
        return response()->json(null, 204);
    }
}
