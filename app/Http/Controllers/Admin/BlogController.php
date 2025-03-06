<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Blog\StoreRequest;
use App\Http\Requests\Admin\Blog\UpdateRequest;

class BlogController extends Controller
{
    public function index()
    {
        return Blog::all();
    }

    public function store(StoreRequest $request)
    {
        $blog = Blog::create($request->validated());
        return response()->json($blog, 201);
    }

    public function show($id)
    {
        return Blog::findOrFail($id);
    }

    public function update(UpdateRequest $request, $id)
    {
        $blog = Blog::findOrFail($id);
        $blog->update($request->validated());
        return response()->json($blog, 200);
    }

    public function destroy($id)
    {
        Blog::destroy($id);
        return response()->json(null, 204);
    }
}
