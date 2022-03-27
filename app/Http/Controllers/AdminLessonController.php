<?php

namespace App\Http\Controllers;

use App\Helper\RedirectHelper;
use App\Models\Lesson;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminLessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['lessons'] = Lesson::all()->load('level');
        // dd(json_decode($data['lessons']));
        return view('admin.lesson.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['levels'] = Level::get();
        return view('admin.lesson.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|regex:/^[a-zA-Z.0-9.\s]+$/|min:3',
            'level_id' => 'required',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all(':message');
            return RedirectHelper::redirectBackStatus('warning', 'Data tidak valid, error: ' . implode(' ', $error));
        }


        Lesson::create([
            'title' => $request['title'],
            'level_id' => $request['level_id'],
        ]);

        return RedirectHelper::redirectRouteStatus('admin.lesson.index', 'success', 'Mata pelajaran berhasil ditambah !');
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
        $lesson =  Lesson::findOrFail($id);
        $data['lesson'] = $lesson->load('level');
        $data['levels'] = Level::get();

        return view('admin.lesson.edit', compact('data'));
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
            'level_id' => 'required',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all(':message');
            return RedirectHelper::redirectBackStatus('warning', 'Data tidak valid, error: ' . implode(' ', $error));
        }
        $lesson = Lesson::findOrFail($id);
        $lesson->update([
            'title' => $request['title'],
            'level_id' => $request['level_id'],
        ]);

        return RedirectHelper::redirectRouteStatus('admin.lesson.index', 'success', 'Mata pelajaran berhasil diedit !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lesson = Lesson::findOrFail($id);
        $lesson->delete();

        return RedirectHelper::redirectBackStatus('success', 'Mata pelajaran berhasil dihapus!');
    }
}
