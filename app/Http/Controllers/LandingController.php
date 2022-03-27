<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Studies;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['quiz'] = Quiz::where('is_sharing', 1)->orderBy('created_at')->limit(3)->get();
        $data['studies'] = Studies::where('is_sharing', 1)->orderBy('created_at')->limit(3)->get();

        return view('landing', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showQuiz($id)
    {
        $quiz = Quiz::findOrFail($id);
        $data['quiz'] = $quiz->load('lesson');

        return view('landing.detail_quiz', compact('data'));
    }

    public function showStudy($id)
    {
        $study = Studies::findOrFail($id);
        $data['study'] = $study->load('lesson');

        return view('landing.detail_study', compact('data'));
    }

    public function allQuiz(){
        $data['quiz'] = Quiz::where('is_sharing', 1)->get();
        return view('landing.all_quiz', compact('data'));
    }

    public function allStudy(){
        $data['study'] = Studies::where('is_sharing', 1)->get();
        return view('landing.all_study', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
