<?php

namespace App\Http\Controllers;
use App\Models\Lesson;
use App\Models\LessonTime;
use App\Models\Course;
use App\Models\LessonMaterial;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Collection;

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
        $this->middleware('can:enter-course,course', ['except'=>['mine']]);
    }
    public function index(Course $course)
    {
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
        if(Gate::allows('course-owner',$course)) {
            return view('courses.lessons.create')->withCourse($course);
        }
        return redirect()->route('courses.lessons.index', ['course' => $course]);
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
        if(Gate::allows('course-owner',$course)) {
            return view('courses.lessons.edit')->withLesson($lesson)->withCourse($course);
        }
        return redirect()->route('courses.lessons.index', ['course' => $course]);
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
        foreach($lesson->lessonMaterials() as $materials){
            $materials->delete();
        }
        $dirToDelete = "/public/course_".$course->id."/lesson_".$lesson->id;
        Storage::deleteDirectory($dirToDelete);
        $lesson->delete();
        return redirect()->route('courses.lessons.index',$course);
    }

    public function mine()
    {
        if(Gate::allows('lecturer')) abort(404);

        $user = Auth::user();
        $lessonTimes = new Collection(new LessonTime());
        if (Gate::allows('student')) {
            foreach($user->courses as $course){
                foreach($course->lessons as $lesson){
                    foreach($lesson->lessonTimes()->whereDate('date', '>=', now())->get() as $lessonTime){
                        $lessonTimes->push($lessonTime);
                    }
                }
            }
        }
        $sortedTimes = $lessonTimes->sort(function($a, $b) {
            if($a->date === $b->date) {
                return $a->time <=> $b->time;
            }
            return $a->date <=> $b->date;
        });
        return view('courses.lessons.mine', ['lessonTimes' => $sortedTimes, 'user' => $user]);
    }
    public function presence(Course $course,Lesson $lesson)
    {
        $lessonTime=$lesson->lessonTimes->first();

        return view('courses.lessons.presence')->withCourse($course)->withLesson($lesson)->withLessonTime($lessonTime);
    }
    public function save(Request $request,Course $course,Lesson $lesson)
    {
        $lessonTimes=$lesson->lessonTimes->first();
        foreach($lesson->course->users as $user)
        {
            $pluses = 0;
            if(request('presence'.$user->id) == 1 ){
                $pluses = request('pluses'.$user->id);
            }
            \DB::table('lesson_time_user')->where([['user_id','=',$user->id],['lesson_time_id','=',$lessonTimes->id]])->updateOrInsert(['user_id'=>$user->id,'lesson_time_id'=>$lessonTimes->id],['presence'=>request('presence'.$user->id),'pluses'=>$pluses]);
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

        //$materials = new LessonMaterial();

        //$materials->lesson_id = $lesson->id;
        //$materials->path = "storage".$pathToFile."/".$fileName;
        //$materials->file_name = $fileName;

        //$materials->save();

        $path = "storage".$pathToFile."/".$fileName;
        $materials = LessonMaterial::firstOrCreate(['lesson_id' =>  $lesson->id, 'path' => $path, 'file_name' =>$fileName  ]);

        return view('courses.lessons.show')->withCourse($course)->withLesson($lesson);
    }

    public function deleteFile( Course $course, Lesson $lesson, LessonMaterial $material)
    {
        //$file = public_path()."/storage/course_".$course->id."/lesson_".$lesson->id."/".$material->file_name;
        $file = storage_path()."/app/public/course_".$course->id."/lesson_".$lesson->id."/".$material->file_name;
        $material->delete();
        unlink($file);
        //File::delete($file);
        return view('courses.lessons.show')->withCourse($course)->withLesson($lesson);
    }
}
