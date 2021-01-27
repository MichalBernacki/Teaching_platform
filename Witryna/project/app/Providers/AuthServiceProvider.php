<?php

namespace App\Providers;
use App\Models\User;
use App\Models\CourseUser;
use App\Models\Course;
use App\Models\Role;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //Gates definition
        //For dean's office employee
        Gate::define('dean', function ($user) {
            $dean_id = Role::where('name',"Dean's office employee")->get()[0]->id;
            if($user->role_id == $dean_id)
                return true;
            return false;
        });

        //for student
        Gate::define('student', function ($user) {
            $student_id = Role::where('name',"Student")->get()[0]->id;
            if($user->role_id == $student_id)
                return true;
            return false;
        });

        //for lecturer
        Gate::define('lecturer', function ($user) {
            $lecturer_id = Role::where('name',"Lecturer")->get()[0]->id;
            if($user->role_id == $lecturer_id)
                return true;
            return false;
        });
        //for lecturer & dean's office employee
        Gate::define('lecturerOrDean', function ($user) {
            $lecturer_id = Role::where('name',"Lecturer")->get()[0]->id;
            $dean_id = Role::where('name',"Dean's office employee")->get()[0]->id;
            if($user->role_id == $lecturer_id || $user->role_id==$dean_id)
                return true;
            return false;
        });

        Gate::define('enter-course', function($user, Course $course)
        {
            $matchThese = ['user_id'=>$user->id,'confirmed'=>true, 'course_id'=>$course->id];
            if( ($user->id == $course->lecturer_id) || CourseUser::where($matchThese)->exists())
                return true;
            return false;
        });

        Gate::define('course-owner', function($user, Course $course)
        {
            if( ($user->id == $course->lecturer_id))
                return true;
            return false;
        });

        Gate::define('give-plusesandpresence', function($user, Course $course)
        {
            if( ($user->id == $course->lecturer_id))
                return true;
            return false;
        });
    }
}
