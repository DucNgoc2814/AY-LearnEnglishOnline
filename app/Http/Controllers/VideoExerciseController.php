<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VideoExerciseController extends Controller
{
    public function show($id)
    {
        // In the future, we can fetch video exercise data based on $id
        return view('online.classes.video-exercise.show');
    }
}
