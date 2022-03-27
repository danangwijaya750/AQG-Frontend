<?php

namespace App\Http\Controllers;

use App\Helper\RedirectHelper;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['levels'] = Level::get();
        return view('admin.level.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.level.create');
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
            'title' => 'required|string|regex:/^[a-zA-Z.0-9.\s]+$/|min:2',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all(':message');
            return RedirectHelper::redirectBackStatus('warning', 'Data tidak valid, error: ' . implode(' ', $error));
        }

        Level::create([
            'title' => $request['title'],
        ]);

        return RedirectHelper::redirectRouteStatus('study.index', 'success', 'Tingkat Pendidikan berhasil ditambah !');
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
        $data['level'] = Level::findOrFail($id);

        return view('admin.level.edit', compact('data'));
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
            'title' => 'required|string|regex:/^[a-zA-Z.0-9.\s]+$/|min:2',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all(':message');
            return RedirectHelper::redirectBackStatus('warning', 'Data tidak valid, error: ' . implode(' ', $error));
        }

        $level = Level::findOrFail($id);
        $level->update([
            'title' => $request['title'],
        ]);

        return RedirectHelper::redirectRouteStatus('study.index', 'success', 'Tingkat Pendidikan berhasil ditambah !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $level = Level::findOrFail($id);
        $level->delete();
        return RedirectHelper::redirectBackStatus('success', 'Tingkat pendidikan berhasil dihapus');
    }
}
