<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\LessonDatesController;
use App\Http\Controllers\LessonMaterialsController;
use Illuminate\Support\Facades\Route;

Route::get('/courses/mine', [CourseController::class, 'mine'])
    ->name('courses.mine');

Route::get('/courses/{course}/generateMark', [CourseController::class, 'generateMark'])
    ->name('courses.generateMark');

Route::get('/courses/{course}/saveMark/{user}', [CourseController::class, 'saveMark'])
    ->name('courses.saveMark');

Route::get('/courses/{course}/listparticipants', [CourseController::class, 'listparticipants'])
    ->name('courses.listparticipants');

Route::get('/courses/{courseid}/confirm/{id}', [CourseController::class, 'confirm'])
    ->name('courses.confirm');

Route::get('/courses/{course}/join', [CourseController::class, 'join'])
    ->name('courses.join');

Route::resource('courses', CourseController::class);

Route::get('/lessons/mine', [LessonController::class, 'mine'])
    ->name('lessons.mine');

Route::post('/courses/{course}/lessons/{lesson}', [LessonController::class, 'upload'])
    ->name('courses.lessons.upload');

Route::post('/courses/{course}/lessons/{lesson}/material/{material}', [LessonController::class, 'deleteFile'])
    ->name('courses.lessons.deleteFile');

Route::resource('courses.lessons', LessonController::class);

Route::get('/courses/{course}/lessons/{lesson}/presence', [LessonController::class, 'presence'])->middleware('can:give-plusesandpresence,course')
    ->name('courses.lessons.presence');
Route::post('/courses/{course}/lessons/{lesson}/save',[LessonController::class, 'save'])->name('courses.lessons.save');;

Route::resource('courses.lessons.dates', LessonDatesController::class);
