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
        if (Auth::check()) {
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
        if( Gate::allows('lecturer')) {
            return view('/courses/create');
        }
        return redirect()->route('courses.mine');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function mine()
    {
        $user = Auth::user();
        if (Gate::allows('student')) {
            $courses = $user->courses;
        } elseif (Gate::allows('lecturer')) {
            $courses = $user->lecturerCourses;
        } else {
            $courses = array();
        }
        return view('courses.mine', ['courses' => $courses, 'user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        return view('courses.edit')->withCourse($course);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
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

    public function listparticipants(Course $course)
    {
        return view('courses.listparticipants')->withCourse($course);
    }

    public function confirm($courseid, $id)
    {
        CourseUser::where(['course_id' => $courseid, 'user_id' => $id])->update(['confirmed' => 1]);
        return redirect()->route('courses.listparticipants', ['course' => $courseid]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //
    }

    public function show(Course $course)
    {
        return view('courses.show', ['course' => $course]);
    }

    public function generateMark(Course $course)
    {
        if( !Gate::allows('lecturer')) {
            return redirect()->route('courses.mine');
        }

        $pluses = [];
        $presence = [];
        $averagepluses = [];
        $percentagepresence = [];

        $users = $course->users;
        foreach ($users as $user) {
            $userPluses = 0;
            $userPresence = 0;
            $lessonCount = 0;
            foreach ($user->lessonTimes as $lessonTime) {
                $userPluses += $lessonTime->pivot->pluses;
                $userPresence += $lessonTime->pivot->presence;
                ++$lessonCount;
            }
            array_push($pluses, $userPluses);
            array_push($presence, $userPresence);

            if ($lessonCount != 0) {
                array_push($averagepluses, $userPluses / $lessonCount);
                array_push($percentagepresence, $userPresence / $lessonCount * 100);
            } else {
                array_push($averagepluses, 0);
                array_push($percentagepresence, 0);
            }
        }

        return view('courses.generateMark')->withUsers($users)->withPresence($presence)->
        withPluses($pluses)->withAveragepluses($averagepluses)->
        withPercentagepresence($percentagepresence)->withCourse($course);
    }


      public function saveMark(Course $course, User $user)
     {
         request()->validate([
             'mark' => 'required|numeric|min:2|max:5',
         ]);
         $mark = request('mark');
         $mark = round($mark*2)/2;

         //CourseUser::where(['course_id' => $course->id, 'user_id' => $user->id])->update(['mark' => $mark ]);
         $course->users()->updateExistingPivot($user->id,['mark'=>$mark]);

         return redirect()->route('courses.mine');
     }


    public function join(Course $course)
    {
        $user = Auth::user();

        if(Gate::allows('student') == false) return redirect()->route('courses.index');

        if( CourseUser::where([['user_id', '=',$user->id], ['course_id', '=',$course->id]])->exists() ){
            return view('courses.join.alreadyJoined')->with('course', $course);
        }else{
            $course_user = new CourseUser();
            $course_user->course_id = $course->id;
            $course_user->user_id = $user->id;
            $course_user->confirmed = 0;
            $course_user->save();

            return view('courses.join.successJoined')->with('course', $course);
        }

        return redirect()->route('courses.index');
    }
}
