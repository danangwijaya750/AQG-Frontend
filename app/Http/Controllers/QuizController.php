<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Quiz;
use App\Models\Level;
use App\Models\Question;
use Auth;
use Carbon\Carbon;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
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
        $all = Quiz::where('user_id', $user_id)->where('is_save', 1)->get();
        // dd($user_id);
        return view('quiz.index', compact('all'));
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
        $all = Quiz::where('user_id', Auth::user()->id)->where('is_save',1)->orderBy('created_at', 'asc')->paginate(10);
        $lessons = Lesson::all();
        $class = Level::all();

        return view('quiz.create', compact('all', 'lessons', 'class'));
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
        // $request->validate([
        //     'title' => 'required'
        // ]);
        $user_id = Auth::user()->id;
        $title = $request->title;
        $level = $request->level;
        $class = $request->class;
        $lesson = $request->lesson;
        $length = $request->length;
        $type = $request->type;
        $materi = $request->materi;
        $is_save = 0;

        $quiz = Quiz::create([
            'user_id' => $user_id,
            'title' => $title,
            'level_id' => $level,
            'class_id' => $class,
            'lesson_id' => $lesson,
            'is_save' => $is_save,
            'length' => $length,
            'type' => $type,
        ]);
        // dd($request);
        // $quiz->save();
        $quiz_id = $quiz->id;

        try {
            //code...
            $base_url = 'http://34.134.75.179';
            $response = Http::asForm()->post($base_url.'/generator', [
                'materi' => $materi
            ]);

            $data = json_decode($response, true);
        } catch (ConnectionException $e) {
            //throw $th;

            return back()->withError($e->getMessage())->withInput();
        }

        // dd($data[0]->q);

        return redirect()->route('quiz.generated', $quiz_id)->with(['data' => $data]);
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
        $quiz = Quiz::where('id',$id)->first();
        $lesson = Lesson::where('id', $quiz->lesson_id)->first();
        $question = Question::where('quiz_id', $id)->get();

        return view('quiz.show', compact('quiz', 'lesson', 'question'));
    }

    public function createPDF($id)
    {
        $quiz = Quiz::where('id',$id)->first();
        $question = Question::where('quiz_id',$id)->get();
        $pdf = PDF::loadview('quiz.quiz_pdf',['question'=>$question],['quiz'=>$quiz]);
        return $pdf->download($quiz->title.'-'.Carbon::now().'.pdf');
    }

    public function createTxt($id){
        $quiz = Quiz::where('id',$id)->first();
        $questions = Question::where('quiz_id',$id)->get();
        $deco = [];
        $decode = collect(json_decode($questions,  true));
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

    public function save(Request $request)
    {
        // $quiz_id = Quiz::findOrFail('id', $id)->first();

        $questions = $request->all();
        // dd($questions);
        $quiz_id = $request->quiz_id;
        for($i = 0; $i < count($questions) - 2; $i++) {
            $question = new Question;
            $question->quiz_id = $quiz_id;
            $question->question = $questions['question'.$i];
            // $question->type = $questions['type'.$i];
            $question->save();
        }

        $quiz = Quiz::where('id', $quiz_id)->first();
        $quiz->is_save = 1;
        $quiz->save();

        return redirect()->route('quiz.index')->with('message', 'Soal Berhasil Disimpan');
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
    public function generated($id)
    {
        //
        $data = session()->get('data');
        if (session()->has('data')) {
            // $quiz_id = Quiz::findOrFail($id)->get();
            $quiz = Quiz::where('id', $id)->first();
            $lesson = Lesson::where('id', $quiz->lesson_id)->first();

            // dd($data);
            return view('quiz.generated', compact('quiz','lesson','data'));
        } else {
            return redirect()->route('quiz.create');
        }

    }



}
