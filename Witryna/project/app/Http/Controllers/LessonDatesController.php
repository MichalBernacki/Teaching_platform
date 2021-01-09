<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonDatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:course-owner,course');
    }
    public function index(Course $course, Lesson $lesson)
    {
            return view('courses.lessons.dates.index',['course' => $course, 'lesson' => $lesson]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Course $course, Lesson $lesson)
    {
        return view('courses.lessons.dates.create',['course' => $course, 'lesson' => $lesson]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Course $course, Lesson $lesson)
    {
        request()->validate([
            'date' => 'required',
            'time' => 'required'
        ]);
        $lessonTime = new LessonTime();
        $lessonTime->date = request('date');
        $lessonTime->time = request('time');
        $lessonTime->lesson_id = $lesson->id;
        $lessonTime->save();
        return redirect()->route('courses.lessons.dates.index',['course' => $course, 'lesson' => $lesson]);
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
    public function edit(Course $course, Lesson $lesson, LessonTime $date)
    {
        return view('courses.lessons.dates.edit',['course' => $course, 'lesson' => $lesson,'date'=>$date]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Course $course, Lesson $lesson, LessonTime $date)
    {
        request()->validate([
            'date' => 'required',
            'time' => 'required'
        ]);
        $date->date = request('date');
        $date->time = request('time');
        $date->update();
        return redirect()->route('courses.lessons.dates.index',['course' => $course, 'lesson' => $lesson]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course, Lesson $lesson, LessonTime $date)
    {
        $date->delete();
        return redirect()->route('courses.lessons.dates.index',['course' => $course, 'lesson' => $lesson]);
    }
}
