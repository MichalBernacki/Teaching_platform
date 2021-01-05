<?php

namespace App\Http\Controllers;
use App\Models\Lesson;
use App\Models\Course;
use App\Models\CourseUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


use DB;

class CourseController extends Controller
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
    public function index()
    {
        $courses = Course::all();
        if(Auth::check()) {
            return view('courses.index')->withCourses($courses);
        }
        return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/courses/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'description' => 'required'

        ]);
        $course = new Course();

        $course->name = request('name');
        $course->lecturer_id = Auth::id();
        $course->description = request('description');

        $course->save();

        return redirect()->route('courses.index', ['course' => $course]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function mine()
    {
        $user = Auth::user();
        if(Gate::allows('student')){
            $courses = $user->courses;
        }
        elseif (Gate::allows('lecturer')){
            $courses = $user->lecturerCourses;
        }
        else{
            $courses = array();
        }
        return view('courses.show',['courses'=>$courses,'user'=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = Course::find($id);
        return view('courses.edit')->withCourse($course);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Course $course)
    {
        request()->validate([
            'name' => ['required'],
            'description' => ['required']
        ]);
        $course->name = request('name');
        $course->description = request('description');
        $course->update();
        return redirect()->route('courses.index');
    }

    public function listparticipants($id)
    {
        $course=Course::find($id);
        return view('courses.listparticipants')->withCourse($course);
    }
    public function confirm($courseid,$id)
    {
        CourseUser::where(['course_id'=>$courseid,'user_id'=>$id])->update(['confirmed'=>1]);
        return redirect()->route('courses.listparticipants',['id'=>$courseid]);
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

    public function course($id)
    {
        $course = Course::find($id);
        $lessons = Lesson::where('course_id',$id)->get();
        return view('courses.course',['course'=>$course,'lessons'=>$lessons]);
    }

    public function generateMark(Course $course)
    {
        $pluses = [];
        $presence = [];
        $averagepluses = [];
        $percentagepresence = [];

        $users = $course->users;
        foreach($users as $user){
            $userPluses = 0;
            $userPresence = 0;
            $lessonCount = 0;
            foreach($user->lessonTimes as $lessonTime){
                $userPluses += $lessonTime->pivot->pluses;
                $userPresence += $lessonTime->pivot->presence;
                ++$lessonCount;
            }
            array_push($pluses, $userPluses);
            array_push($presence, $userPresence);

            if($lessonCount != 0) {
                array_push($averagepluses, $userPluses / $lessonCount);
                array_push($percentagepresence, $userPresence / $lessonCount * 100);
            }
            else{
                array_push($averagepluses, 0);
                array_push($percentagepresence, 0);
            }
        }

        return view('courses.generateMark')->withUsers($users)->withPresence($presence)->withPluses($pluses)->
        withAveragepluses($averagepluses)->withPercentagepresence($percentagepresence);
    }


   /* public function saveMark()
    {
        return view('courses.generateMark');
    }
   */



}

/*
public function generateArraysForMarks(&$classActivity, &$averageValue, $givenOption, $user)
{
    $toRemove = array('[',']');

    $getValue= \DB::table('lesson_users')->where('user_id',$user->id)->pluck($givenOption);

    $newValue = str_replace($toRemove, "", $getValue);

    array_push($classActivity , $newValue);

    $parts = explode(',',$newValue);
    array_push($averageValue , array_sum($parts)/count($parts));

}
*/
