<?php

namespace App\Http\Controllers;

use App\Models\AnswerFinalExam;
use Illuminate\Http\Request;

class AnswerFinalExamController extends Controller
{
    public function index()
    {
        return AnswerFinalExam::all();
    }

    public function store(Request $request)
    {
        $answerFinalExam = AnswerFinalExam::create($request->all());
        return response()->json($answerFinalExam, 201);
    }

    public function show($id)
    {
        return AnswerFinalExam::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $answerFinalExam = AnswerFinalExam::findOrFail($id);
        $answerFinalExam->update($request->all());
        return response()->json($answerFinalExam, 200);
    }

    public function destroy($id)
    {
        AnswerFinalExam::destroy($id);
        return response()->json(null, 204);
    }
}
