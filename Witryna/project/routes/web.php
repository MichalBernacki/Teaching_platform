<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::resource('lessons' ,LessonController::class);
Route::get('lessons/create/{id}',[LessonController::class,'create'])->name('lessons.create');
Route::get('courses/{id}/course',[CourseController::class,'course'])->name('courses.course');
Route::resource('comments',CommentController::class);

Route::get('/courses/mine', [CourseController::class, 'mine'])->name('courses.mine');
Route::resource('courses' ,CourseController::class);
Route::resource('users', UsersController::class)->only([
    'index', 'edit', 'update'
]);;
Route::post('/users/{id}/update',[App\Http\Controllers\UsersController::class,'update'])->middleware('auth');

Route::get('/courses/{id}/generateMark',[CourseController::class,'generateMark'])->name('courses.generateMark');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/courses/{id}/listparticipants',[CourseController::class,'listparticipants'])->name('courses.listparticipants');
Route::get('/courses/{courseid}/confirm/{id}',[CourseController::class,'confirm']);


require __DIR__.'/auth.php';
