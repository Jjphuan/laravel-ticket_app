<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//login && register
Route::post('/register',[UserController::class, 'register']);
Route::post('/login',[UserController::class, 'login'])
    ->middleware('throttle:5,3');

// question
Route::get('/question',[QuestionController::class,'all']);
Route::post('/add_question',[QuestionController::class,'addQuestion']);
Route::get('/get_question',[QuestionController::class,'getQuestionDetails']);
Route::post('/edit_question',[QuestionController::class,'editQuestion']);
Route::post('/edit_show',[QuestionController::class,'editShow']);
Route::post('/delete_question',[QuestionController::class,'deleteQuestion']);

// discount
Route::get('/discount',[DiscountController::class,'showDiscount']);
Route::post('/add_discount',[DiscountController::class,'addDiscount']);
Route::get('/get_discount',[DiscountController::class,'getDiscount']);
Route::post('/edit_discount',[DiscountController::class,'editDiscount']);

// ticket 
Route::get('/all_tickets',[TicketController::class,'allTicket']);
Route::get('/get_bus',[TicketController::class,'getBus']);
Route::get('/get_tickets',[TicketController::class,'getTicket']);
Route::post('/add_tickets',[TicketController::class,'addTicket']);
Route::post('/edit_tickets',[TicketController::class,'editTicket']);
Route::get('/search_tickets',[TicketController::class,'searchTicket']);

Route::middleware('auth:sanctum')->group(function (){
    Route::post('/logout',[UserController::class,'logout']);
    Route::post('/user',[UserController::class,'user']);
});