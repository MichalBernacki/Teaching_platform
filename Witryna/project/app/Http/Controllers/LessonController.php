<?php

namespace App\Http\Controllers;
use App\Models\Lesson;
use App\Models\LessonTime;
use App\Models\Course;
use App\Models\LessonMaterials;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:enter-course,course');
    }
    public function index(Course $course)
    {
        //$lessons = Lesson::where('course_id',$course->id)->get();
        $lessons = $course->lessons;
        if(Auth::check()) {
            return view('courses.lessons.index')->withLessons($lessons)->withCourse($course);
        }
        return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Course $course)
    {
        return view('courses.lessons.create')->withCourse($course);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Course $course)
    {
        request()->validate([
            'title' => 'required',
            'description' => 'required',
            'date' => 'required',
            'time' => 'required'
        ]);
        $lesson = new Lesson();
        $lesson->course_id=$course->id;
        $lesson->title = request('title');
        $lesson->description = request('description');
        $lessonTime = new LessonTime();
        $lesson->save();
        $lessonTime->date = request('date');
        $lessonTime->time = request('time');
        $lessonTime->lesson_id = $lesson->id;
        $lessonTime->save();
        return redirect()->route('courses.lessons.index',$course);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course,Lesson $lesson)
    {
        return view('courses.lessons.show')->withCourse($course)->withLesson($lesson);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course, Lesson $lesson)
    {
        return view('courses.lessons.edit')->withLesson($lesson)->withCourse($course);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Course $course, Lesson $lesson)
    {
        request()->validate([
            'title' => ['required'],
            'description' => ['required']
        ]);
        $lesson->title = request('title');
        $lesson->description = request('description');
        $lesson->update();
        return redirect()->route('courses.lessons.index',$course);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course, Lesson $lesson)
    {
        $dirToDelete = "/public/course_".$course->id."/lesson_".$lesson->id;
        Storage::deleteDirectory($dirToDelete);
        $lesson->delete();
        return redirect()->route('courses.lessons.index',$course);
    }

    public function mine()
    {
        $user = Auth::user();
        $lessonTimes = array();
        if (Gate::allows('student')) {
            foreach($user->lessonTimes()->whereDate('date', '>=', now())
                        ->orderBy('date')->orderBy('time')->get() as $lessonTime){
                array_push($lessonTimes, $lessonTime);
            }
        }
        return view('courses.lessons.mine', ['lessonTimes' => $lessonTimes, 'user' => $user]);
    }
    public function presence(Course $course,Lesson $lesson)
    {
        return view('courses.lessons.presence')->withCourse($course)->withLesson($lesson);
    }
    public function save(Request $request,Course $course,Lesson $lesson)
    {
        $lessonTimes=$lesson->lessonTimes->first();
        foreach($lesson->course->users as $user)
        {
            \DB::table('lesson_time_user')->where([['user_id','=',$user->id],['lesson_time_id','=',$lessonTimes->id]])->updateOrInsert(['user_id'=>$user->id,'lesson_time_id'=>$lessonTimes->id],['presence'=>request('presence'.$user->id),'pluses'=>request('pluses'.$user->id)]);
        }
        return redirect()->route('courses.lessons.show',[$course,$lesson]);
    }


    public function upload(Course $course,Lesson $lesson)
    {
        request()->validate([
            'file' => 'required'
        ]);

        $file = request('file');
        $fileName = request()->file('file')->getClientOriginalName();

        $pathToFile = "/course_".$course->id."/lesson_".$lesson->id;

        $file->storeAs("public".$pathToFile, $fileName);

        $materials = new LessonMaterials();

        $materials->lesson_id = $lesson->id;
        $materials->path = "storage".$pathToFile."/".$fileName;
        $materials->file_name = $fileName;
        $materials->save();

        return view('courses.lessons.show')->withCourse($course)->withLesson($lesson);
    }
}
