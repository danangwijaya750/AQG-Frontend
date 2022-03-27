<?php

namespace App\Http\Controllers;

use App\Helper\RedirectHelper;
use App\Models\Lesson;
use App\Models\Level;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminQuizController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $quiz = Quiz::get();
        $data['quizzes'] = $quiz->load('user');
        return view('admin.quiz.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['quiz'] = Quiz::where('user_id', Auth::user()->id)->orderBy('created_at', 'asc')->paginate(10);
        $data['lessons'] = Lesson::all()->load('level');
        $data['levels'] = Level::get();

        return view('admin.quiz.create', compact('data'));
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
            'level_id' => 'required',
            'lesson_id' => 'required',
            'is_sharing' => 'required',
            'lesson' => 'required'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all(':message');
            return RedirectHelper::redirectBackStatus('warning', 'Data tidak valid, error: ' . implode(' ', $error));
        }

        $lesson = strip_tags($request->lesson);
        $hash = base64_encode($lesson);
        $user_id = Auth::user()->id;
        $lesson_data = Lesson::findOrFail($request->lesson_id);
        $level_data = Level::findOrFail($request->level_id);
        $temp_data = array('user_id'=> $user_id,'title' => $request->title, 'level_id' =>$request->level_id, 'lesson_id' => $request->lesson_id, 'level_name' => $level_data->title,'lesson_name'=>$lesson_data->title,'lesson' => $lesson,'hash' => $hash  ,'is_sharing' => $request->is_sharing);

        // try {
        //     //code...
        //     $base_url = 'http://35.239.111.176';
        //     $response = Http::asForm()->post($base_url.'/generator', [
        //         'materi' => $lesson
        //     ]);

        //     $data = json_decode($response, true);
        // } catch (ConnectionException $e) {
        //     //throw $th;
        //     return back()->withError($e->getMessage())->withInput();
        // }

        $json = '[{"c":"C0","name":"C1-Mengingat","q":["aaaa","bbbb","hehehe"]},{"c":"C1","name":"C2-Memahami","q":["aaaac2","bbbbc2","hehehec2"]}]';
        $question = json_decode($json,true);

        $data = array('data' => $temp_data, 'questions' => $question);

        return redirect()->route('admin.quiz.generated', ['id' => $user_id, 'hash' => $hash])->with(['data' => $data, notify()->success('Soal berhasil digenerate !','success',"topRight")]);
    }

    public function save(Request $request)
    {
        try {
            $quiz = new Quiz();
            $quiz->title = $request->title;
            $quiz->user_id = $request->user_id;
            $quiz->lesson_id = $request->lesson_id;
            $quiz->is_sharing = $request->is_sharing;
            $quiz->questions = json_encode($request->questions);
            $quiz->save();

            return RedirectHelper::redirectRouteStatus('admin.quiz.index','success','Soal berhasil disimpan !');
        } catch (\Exception $e) {
            return RedirectHelper::redirectBackStatus('warning','Whoops !'.$e->getMessage());
        }
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
        $quiz = Quiz::findOrFail($id);
        $data['quiz'] = $quiz->load('lesson');
        $data['levels'] =Level::get();
        // dd(json_decode($data['quiz']));
        return view('admin.quiz.edit', compact('data'));
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
        try {
            $quiz = Quiz::findOrFail($id);
            $quiz->title = $request->title;
            $quiz->user_id = Auth()->user()->id;
            $quiz->lesson_id = $request->lesson_id;
            $quiz->is_sharing = $request->is_sharing;
            $quiz->questions = json_encode($request->questions);
            $quiz->save();

            return RedirectHelper::redirectRouteStatus('admin.quiz.index','success','Soal berhasil disimpan !');
        } catch (\Exception $e) {
            return RedirectHelper::redirectBackStatus('warning','Whoops !'.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->delete();

        return RedirectHelper::redirectBackStatus('warning', 'Soal berhasil dihapus !');
    }

    public function generated()
    {
        if (session()->has('data')) {
            $data['quiz'] = session()->get('data');
            // dd($data['quiz']);
            $data['lesson'] = Lesson::get();
            return view('admin.quiz.generated',compact('data'));
        } else {
            return RedirectHelper::redirectBackStatus('warning', 'Sesi telah habis, silahkan ulangi kembali !');
        }

    }
}
