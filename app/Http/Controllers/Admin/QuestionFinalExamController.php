<?php

namespace App\Http\Controllers;

use App\Models\QuestionFinalExam;
use Illuminate\Http\Request;

class QuestionFinalExamController extends Controller
{
    public function index()
    {
        return QuestionFinalExam::all();
    }

    public function store(Request $request)
    {
        $questionFinalExam = QuestionFinalExam::create($request->all());
        return response()->json($questionFinalExam, 201);
    }

    public function show($id)
    {
        return QuestionFinalExam::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $questionFinalExam = QuestionFinalExam::findOrFail($id);
        $questionFinalExam->update($request->all());
        return response()->json($questionFinalExam, 200);
    }

    public function destroy($id)
    {
        QuestionFinalExam::destroy($id);
        return response()->json(null, 204);
    }
}
