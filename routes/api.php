<?php

use App\Http\Controllers\Apis\AuthController;
use App\Http\Controllers\Apis\BlogsController;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user(); 
});


Route::post('/login',[AuthController::class,'Login']);
Route::post('/register',[AuthController::class,'Register']);

Route::group( ['middleware' => ['auth:sanctum']], function(){

    Route::post('/logout',[AuthController::class,'Logout']);
    Route::resource('blogs',BlogsController::class);

});