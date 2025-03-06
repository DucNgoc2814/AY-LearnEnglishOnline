<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function index()
    {
        return Certificate::all();
    }

    public function store(Request $request)
    {
        $certificate = Certificate::create($request->all());
        return response()->json($certificate, 201);
    }

    public function show($id)
    {
        return Certificate::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $certificate = Certificate::findOrFail($id);
        $certificate->update($request->all());
        return response()->json($certificate, 200);
    }

    public function destroy($id)
    {
        Certificate::destroy($id);
        return response()->json(null, 204);
    }
}
