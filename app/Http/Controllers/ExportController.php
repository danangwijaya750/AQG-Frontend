<?php

namespace App\Http\Controllers;

use App\Helper\RedirectHelper;
use App\Models\Level;
use App\Models\Quiz;
use App\Models\Studies;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade as PDF;

class ExportController extends Controller
{
    public function exportPDF($id)
    {
        $quiz = Quiz::findOrFail($id);
        $data['quiz'] = $quiz->load('lesson');
        $data['levels'] = Level::get();
        $pdf = PDF::loadview('export.quiz',compact('data'));
        return $pdf->download($data['quiz']['title'].'-'.Carbon::now().'.pdf');
    }

    public function exportStudyPDF($id)
    {
        $study = Studies::findOrFail($id);
        $data['study'] = $study->load('lesson');
        $data['levels'] = Level::get();
        $pdf = PDF::loadview('export.study',compact('data'));
        return $pdf->download($data['study']['title'].'-'.Carbon::now().'.pdf');
    }


    public function createTxt($id){
        $quiz = Quiz::where('id',$id)->first();
        $deco = [];
        $decode = collect(json_decode($quiz,  true));
        foreach ($decode as $d){
            array_push($deco, $d['question']);
        }
        array_push($deco, " ");
        $filetext = implode("{}\n",$deco);
        $name = $quiz->title.'-'.Carbon::now().'.txt';
        $headers = ['Content-type'=>'text/plain',
        'Content-Disposition'=>sprintf('attachment; filename="%s"', $name),
        ];

        return response($filetext, 200, $headers);
    }

}
