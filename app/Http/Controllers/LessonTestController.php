<?php

namespace App\Http\Controllers;

use App\Models\LessonTest;
use Illuminate\Http\Request;

class LessonTestController extends Controller
{
    public function index()
    {
        return LessonTest::all();
    }

    public function store(Request $request)
    {
        $lessonTest = LessonTest::create($request->all());
        return response()->json($lessonTest, 201);
    }

    public function show($id)
    {
        return LessonTest::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $lessonTest = LessonTest::findOrFail($id);
        $lessonTest->update($request->all());
        return response()->json($lessonTest, 200);
    }

    public function destroy($id)
    {
        LessonTest::destroy($id);
        return response()->json(null, 204);
    }
}
