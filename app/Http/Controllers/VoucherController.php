<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function index()
    {
        return Voucher::all();
    }

    public function store(Request $request)
    {
        $voucher = Voucher::create($request->all());
        return response()->json($voucher, 201);
    }

    public function show($id)
    {
        return Voucher::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $voucher = Voucher::findOrFail($id);
        $voucher->update($request->all());
        return response()->json($voucher, 200);
    }

    public function destroy($id)
    {
        Voucher::destroy($id);
        return response()->json(null, 204);
    }
}
