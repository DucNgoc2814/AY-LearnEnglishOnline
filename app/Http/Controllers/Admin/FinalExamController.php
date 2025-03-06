<?php

namespace App\Http\Controllers;

use App\Models\FinalExam;
use Illuminate\Http\Request;

class FinalExamController extends Controller
{
    public function index()
    {
        return FinalExam::all();
    }

    public function store(Request $request)
    {
        $finalExam = FinalExam::create($request->all());
        return response()->json($finalExam, 201);
    }

    public function show($id)
    {
        return FinalExam::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $finalExam = FinalExam::findOrFail($id);
        $finalExam->update($request->all());
        return response()->json($finalExam, 200);
    }

    public function destroy($id)
    {
        FinalExam::destroy($id);
        return response()->json(null, 204);
    }
}
