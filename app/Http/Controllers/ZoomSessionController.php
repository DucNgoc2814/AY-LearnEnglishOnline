<?php

namespace App\Http\Controllers;

use App\Models\ZoomSession;
use Illuminate\Http\Request;

class ZoomSessionController extends Controller
{
    public function index()
    {
        return ZoomSession::all();
    }

    public function store(Request $request)
    {
        $zoomSession = ZoomSession::create($request->all());
        return response()->json($zoomSession, 201);
    }

    public function show($id)
    {
        return ZoomSession::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $zoomSession = ZoomSession::findOrFail($id);
        $zoomSession->update($request->all());
        return response()->json($zoomSession, 200);
    }

    public function destroy($id)
    {
        ZoomSession::destroy($id);
        return response()->json(null, 204);
    }
}
