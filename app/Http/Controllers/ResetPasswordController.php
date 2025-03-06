<?php

namespace App\Http\Controllers;

use App\Models\ResetPassword;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    public function index()
    {
        return ResetPassword::all();
    }

    public function store(Request $request)
    {
        $resetPassword = ResetPassword::create($request->all());
        return response()->json($resetPassword, 201);
    }

    public function show($id)
    {
        return ResetPassword::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $resetPassword = ResetPassword::findOrFail($id);
        $resetPassword->update($request->all());
        return response()->json($resetPassword, 200);
    }

    public function destroy($id)
    {
        ResetPassword::destroy($id);
        return response()->json(null, 204);
    }
}
