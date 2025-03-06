<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function index()
    {
        return Rating::all();
    }

    public function store(Request $request)
    {
        $rating = Rating::create($request->all());
        return response()->json($rating, 201);
    }

    public function show($id)
    {
        return Rating::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $rating = Rating::findOrFail($id);
        $rating->update($request->all());
        return response()->json($rating, 200);
    }

    public function destroy($id)
    {
        Rating::destroy($id);
        return response()->json(null, 204);
    }
}
