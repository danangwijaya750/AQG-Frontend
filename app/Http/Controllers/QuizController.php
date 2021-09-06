<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Quiz;
use App\Models\Level;
use Auth;

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
        $all = Quiz::where('user_id', $user_id)->get();
        // dd($user_id);
        return view('quiz.index', compact('all'));
    }

    public function search($request)
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
        $all = Quiz::orderBy('created_at', 'desc')->paginate(10);
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


        $quiz = Quiz::create([
            'user_id' => $user_id,
            'title' => $title,
            'level_id' => $level,
            'class_id' => $class,
            'lesson_id' => $lesson,
            'length' => $length,
            'type' => $type,
        ]);
        // dd($request);
        $quiz->save();
        $quiz_id = $quiz->id;

        return redirect()->route('quiz.generated', $quiz_id);
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
        $quiz_id = Quiz::findOrFail($id)->get();
        $quiz = Quiz::where('id', $id)->first();
        $lesson = Lesson::where('id', $quiz->lesson_id)->first();
        // dd($lesson);

        return view('quiz.generated', compact('quiz_id','quiz','lesson'));
    }


}
