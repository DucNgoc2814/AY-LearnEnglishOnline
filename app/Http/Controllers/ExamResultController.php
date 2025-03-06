<?php

namespace App\Http\Controllers;

use App\Models\ExamResult;
use Illuminate\Http\Request;

class ExamResultController extends Controller
{
    public function index()
    {
        return ExamResult::all();
    }

    public function store(Request $request)
    {
        $examResult = ExamResult::create($request->all());
        return response()->json($examResult, 201);
    }

    public function show($id)
    {
        return ExamResult::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $examResult = ExamResult::findOrFail($id);
        $examResult->update($request->all());
        return response()->json($examResult, 200);
    }

    public function destroy($id)
    {
        ExamResult::destroy($id);
        return response()->json(null, 204);
    }
}
