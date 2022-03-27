<?php

namespace App\Http\Controllers;

use App\Helper\RedirectHelper;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Quiz;
use App\Models\Level;
use App\Models\Question;
use App\Models\Studies;
use Carbon\Carbon;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use PDF;

class QuizController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user_id = Auth::user()->id;
        $data['quizzes'] = Quiz::where('user_id', $user_id)->get();
        return view('quiz.index', compact('data'));
    }

    public function search(Request $request)
    {
        $lessons = [];
        if($request->has('q')){
            $search = $request->q;
            $lessons = Lesson::select('id','title')
                    ->where('name', 'LIKE', "%$search%")
            		->get();
        }
        return response()->json($lessons);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data['quiz'] = Quiz::where('user_id', Auth::user()->id)->orderBy('created_at', 'asc')->paginate(10);
        $data['lessons'] = Lesson::all()->load('level');
        $data['levels'] = Level::get();
        $data['studies'] = Studies::where('user_id',Auth::user()->id )->get();

        return view('quiz.create', compact('data'));
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
            'lesson' => 'required|min:50'
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

        try {

            $base_url = 'http://34.123.179.240';
            $response = Http::asForm()->post($base_url.'/generator', [
                'materi' => $lesson
            ]);

            // $jsonfile = json_decode($response, true);
            $question = json_decode($response,true);

            $data = array('data' => $temp_data, 'questions' => $question);

            return redirect()->route('quiz.generated', ['id' => $user_id, 'hash' => $hash])->with(['data' => $data, notify()->success('Soal berhasil digenerate !','success',"topRight")]);
        } catch (ConnectionException $e) {
            //throw $th;
            return RedirectHelper::redirectBackStatus('warning', 'Whoops '.$e->getMessage());

        }

        // $json = '[{"c":"C0","name":"C1-Mengingat","q":["aaaa","bbbb","hehehe"]},{"c":"C1","name":"C2-Memahami","q":["aaaac2","bbbbc2","hehehec2"]}]';

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    public function save(Request $request)
    {
        // dd($request->all());
        try {
            $quiz = new Quiz();
            $quiz->title = $request->title;
            $quiz->user_id = $request->user_id;
            $quiz->lesson_id = $request->lesson_id;
            $quiz->is_sharing = $request->is_sharing;
            $quiz->questions = json_encode($request->questions);
            $quiz->save();

            return RedirectHelper::redirectRouteStatus('quiz.index','success','Soal berhasil disimpan !');
        } catch (\Exception $e) {
            return RedirectHelper::redirectBackStatus('warning','Whoops !'.$e->getMessage());
        }
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
        return view('quiz.edit', compact('data'));
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

            return RedirectHelper::redirectRouteStatus('quiz.index','success','Soal berhasil disimpan !');
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

        return RedirectHelper::redirectBackStatus('success', 'Soal berhasil dihapus !');
    }

    public function generated()
    {
        if (session()->has('data')) {
            $data['quiz'] = session()->get('data');
            // dd($data['quiz']);
            $data['lesson'] = Lesson::get();
            return view('quiz.generated',compact('data'));
        } else {
            return RedirectHelper::redirectBackStatus('warning', 'Sesi telah habis, silahkan ulangi kembali !');
        }

    }



}
