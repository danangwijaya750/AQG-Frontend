<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function getLesson($level_id){
        $lesson = Lesson::where('level_id', $level_id)->get();
        return response()->json($lesson);
    }
}
