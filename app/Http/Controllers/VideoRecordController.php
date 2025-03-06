<?php

namespace App\Http\Controllers;

use App\Models\VideoRecord;
use Illuminate\Http\Request;

class VideoRecordController extends Controller
{
    public function index()
    {
        return VideoRecord::all();
    }

    public function store(Request $request)
    {
        $videoRecord = VideoRecord::create($request->all());
        return response()->json($videoRecord, 201);
    }

    public function show($id)
    {
        return VideoRecord::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $videoRecord = VideoRecord::findOrFail($id);
        $videoRecord->update($request->all());
        return response()->json($videoRecord, 200);
    }

    public function destroy($id)
    {
        VideoRecord::destroy($id);
        return response()->json(null, 204);
    }
}
