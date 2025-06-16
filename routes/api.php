<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::post('/register',[UserController::class, 'register']);
Route::post('/login',[UserController::class, 'login'])
    ->middleware('throttle:5,3');
    
Route::get('/question',[QuestionController::class,'all']);
Route::post('/add_question',[QuestionController::class,'addQuestion']);
Route::get('/get_question',[QuestionController::class,'getQuestionDetails']);
Route::post('/edit_question',[QuestionController::class,'editQuestion']);
Route::post('/edit_show',[QuestionController::class,'editShow']);
Route::post('/delete_question',[QuestionController::class,'deleteQuestion']);

Route::middleware('auth:sanctum')->group(function (){
    Route::post('/logout',[UserController::class,'logout']);
    Route::post('/user',[UserController::class,'user']);
});