<?php

use App\Http\Controllers\CourseController;
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

Route::resource('comments',CommentController::class);
Route::resource('courses' ,CourseController::class);
Route::resource('/comments', App\Http\Controllers\CommentController::class);
Route::resource('users', UsersController::class)->only([
    'index', 'edit', 'update'
]);;
Route::post('/users/{id}/update',[App\Http\Controllers\UsersController::class,'update'])->middleware('auth');

Route::get('/courses/{id}/generateMark',[CourseController::class,'generateMark'])->name('courses.generateMark');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');



require __DIR__.'/auth.php';
