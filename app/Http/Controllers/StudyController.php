<?php

namespace App\Http\Controllers;

use App\Helper\RedirectHelper;
use App\Models\Lesson;
use App\Models\Level;
use App\Models\Studies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StudyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user_id = Auth::user()->id;
        $data['studies'] = Studies::where('user_id', $user_id)->get();

        return view('studies.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = Auth::user()->id;
        $data['lessons'] = Lesson::get();
        $data['levels'] = Level::get();
        $data['study'] = Studies::where('user_id', $user_id)->orderBy('created_at')->get();

        return view('studies.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|regex:/^[a-zA-Z.0-9.\s]+$/|min:3',
            'desc' => 'required|string|min:3',
            'level_id' => 'required',
            'lesson_id' => 'required',
            'is_sharing' => 'required'

        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all(':message');
            return RedirectHelper::redirectBackStatus('warning', 'Data tidak valid, error: ' . implode(' ', $error));
        }

        $study  = New Studies();
        $study->title = $request->title;
        $study->desc = $request->desc;
        $study->lesson_id = $request->lesson_id;
        $study->user_id = Auth::user()->id;
        $study->is_sharing = $request->is_sharing;
        $study->save();

        return RedirectHelper::redirectRouteStatus('study.index', 'success', 'Materi berhasil ditambah !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $study = Studies::findOrFail($id);
        $user_id = Auth::user()->id;
        $data['study'] = $study->load('user', 'lesson');
        $data['lesson'] = Lesson::get();
        $data['levels']  = Level::get();
        $data['studies'] = Studies::where('user_id', $user_id)->orderBy('created_at')->get();
        // dd(json_decode($data['study']['lesson']['level_id']));

        return view('studies.edit',compact('data'));


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
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|regex:/^[a-zA-Z.0-9.\s]+$/|min:3',
            'desc' => 'required|string|min:3',
            'level_id' => 'required',
            'lesson_id' => 'required',
            'is_sharing' => 'required'

        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all(':message');
            return RedirectHelper::redirectBackStatus('warning', 'Data tidak valid, error: ' . implode(' ', $error));
        }

        $study  = Studies::findOrFail($id);
        $study->title = $request->title;
        $study->desc = $request->desc;
        $study->lesson_id = $request->lesson_id;
        $study->user_id = Auth::user()->id;
        $study->is_sharing = $request->is_sharing;
        $study->save();

        return RedirectHelper::redirectRouteStatus('study.index', 'success', 'Materi berhasil diedit !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $study  = Studies::findOrFail($id);
        $study->delete();

        return RedirectHelper::redirectBackStatus('success', 'Materi berhasil dihapus !');

    }


}
