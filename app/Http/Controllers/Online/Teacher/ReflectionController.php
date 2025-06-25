<?php

namespace App\Http\Controllers\Online\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReflectionController extends Controller
{
    public function detail($class_id, $student_id)
    {
        // TODO: Get class and student data from database
        return view('online.teacher.classes.progress.reflection-detail');
    }
}
