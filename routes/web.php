<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Auth;
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


// all
Route::get('/blogs',[BlogController::class,'index'])->name('blogs.index');

// // show one
// Route::get('/blogs/{id}',[BlogController::class,'show'])->whereNumber('id')->name('blogs.show');

// // create
// Route::get('/blogs/create',[BlogController::class,'create'])->name('blogs.create');

// // edit
// Route::get('/blogs/edit/{id}',[BlogController::class,'edit'])->whereNumber('id')->name('blogs.edit');

// // update
// Route::put('/blogs/{id}',[BlogController::class,'update'])->whereNumber('id')->name('blogs.update');

// // store
// Route::post('/blogs',[BlogController::class,'store'])->name('blogs.store');

// // delete
// Route::delete('/blogs/{id}',[BlogController::class,'destroy'])->whereNumber('id')->name('blogs.destroy');

Route::resource('blogs',BlogController::class)->middleware('auth');
Route::get('/blogs/restore/{id}',[BlogController::class,'restore'])->whereNumber('id')->name('blogs.restore');

Auth::routes();

Route::get('/auth/github/redirect', [AuthController::class, 'redirect'])->name('github.login');
Route::get('/auth/github/callback', [AuthController::class, 'callback']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
