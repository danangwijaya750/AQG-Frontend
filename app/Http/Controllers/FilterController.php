<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Studies;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function getLesson($level_id){
        $lesson = Lesson::where('level_id', $level_id)->get();
        return response()->json($lesson);
    }

    public function getStudy($id){
        $study = Studies::where('id', $id)->get();
        return response()->json($study);
    }
}
