<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function show($id)
    {
        $user = \DB::table('users')->where('id',$id)->first();
        $courses = Course::where('lecturer_id',$user->id)->get();
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




    public function generateMark($id)
    {
        $users = User::all();
        $pluses = [];
        $presence = [];
        $averagepluses = [];
        $percentagepresence = [];
        $toRemove = array('[',']');

        foreach($users as $user){

            $getPluses= \DB::table('lesson_users')->where('user_id',$user->id)->pluck('pluses');
            $getPresence = \DB::table('lesson_users')->where('user_id',$user->id)->pluck('presence');

            $newPluses = str_replace($toRemove, "", $getPluses);
            $newPresence = str_replace($toRemove, "", $getPresence);

            array_push($presence , $newPluses);
            array_push($pluses , $newPresence);

            $parts = explode(',',$newPluses);
            array_push($averagepluses , array_sum($parts)/count($parts));

            $parts = explode(',',$newPluses);
            array_push($percentagepresence , ( array_sum($parts)/count($parts) )*100 );
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
