<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReflectionExerciseController extends Controller
{
    public function show($id)
    {
        $title = "REFLECTION 1: HOMETOWN";
        return view('online.classes.reflection-exercise.show', compact('title'));
    }
}
