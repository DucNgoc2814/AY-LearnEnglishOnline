<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index()
    {
        return Enrollment::all();
    }

    public function store(Request $request)
    {
        $enrollment = Enrollment::create($request->all());
        return response()->json($enrollment, 201);
    }

    public function show($id)
    {
        return Enrollment::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $enrollment->update($request->all());
        return response()->json($enrollment, 200);
    }

    public function destroy($id)
    {
        Enrollment::destroy($id);
        return response()->json(null, 204);
    }
}
