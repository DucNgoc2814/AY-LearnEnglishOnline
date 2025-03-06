<?php

namespace App\Http\Controllers;

use App\Models\AnswerLessonTest;
use Illuminate\Http\Request;

class AnswerLessonTestController extends Controller
{
    public function index()
    {
        return AnswerLessonTest::all();
    }

    public function store(Request $request)
    {
        $answerLessonTest = AnswerLessonTest::create($request->all());
        return response()->json($answerLessonTest, 201);
    }

    public function show($id)
    {
        return AnswerLessonTest::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $answerLessonTest = AnswerLessonTest::findOrFail($id);
        $answerLessonTest->update($request->all());
        return response()->json($answerLessonTest, 200);
    }

    public function destroy($id)
    {
        AnswerLessonTest::destroy($id);
        return response()->json(null, 204);
    }
}
