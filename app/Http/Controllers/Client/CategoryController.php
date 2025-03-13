<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\BaseController;
use App\Models\Category;
use App\Models\Course;

/**
 * @package App\Http\Controllers\Client
 * @author Assistant
 * @description Handles course functionality for client users
 */
class CategoryController extends BaseController
{
    /**
     * Display the homepage
     *
     * @return \Illuminate\View\View
     */
    public function index(?string $slug = null)
    {
        if ($slug) {
            $category = Category::where('slug', $slug)->firstOrFail();
            $courses = $category->courses()->paginate(6);
            $category->setRelation('courses', $courses);
            $data = collect([$category]);
        } else {
            $allCourses = Course::paginate(6);
            $data = collect([
                (object)[
                    'courses' => $allCourses
                ]
            ]);
        }

        if (request()->ajax()) {
            $html = view('client.categories.coursesList', ['data' => $data])->render();
            return response()->json([
                'status' => true,
                'html' => $html
            ]);
        }

        $categories = Category::with('courses')->get();
        return view('client.categories.index', [
            'data' => $data,
            'categories' => $categories
        ]);
    }

}
