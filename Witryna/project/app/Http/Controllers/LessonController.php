<?php

namespace App\Http\Controllers;
use App\Models\Lesson;
use App\Models\LessonTime;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
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
    public function destroy($id)
    {
        //
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
}
