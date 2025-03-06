<?php

namespace App\Http\Controllers;

use App\Models\Progress;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    public function index()
    {
        return Progress::all();
    }

    public function store(Request $request)
    {
        $progress = Progress::create($request->all());
        return response()->json($progress, 201);
    }

    public function show($id)
    {
        return Progress::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $progress = Progress::findOrFail($id);
        $progress->update($request->all());
        return response()->json($progress, 200);
    }

    public function destroy($id)
    {
        Progress::destroy($id);
        return response()->json(null, 204);
    }
}
