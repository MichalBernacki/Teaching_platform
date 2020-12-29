<?php

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

Route::resource('/comments', App\Http\Controllers\CommentController::class);
Route::resource('/users', App\Http\Controllers\UsersController::class);
Route::post('/users/{id}/changerole',[App\Http\Controllers\UsersController::class,'changerole'])->middleware('auth');
Route::get('/users/{id}/changerole',[App\Http\Controllers\UsersController::class,'change'])->middleware('auth');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');



require __DIR__.'/auth.php';
