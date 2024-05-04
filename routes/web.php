<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AssistController;


Route::get('/', function () {
    return view('welcome');
});
Route::resource('products', ProductController::class);
Route::resource('students', StudentController::class);
Route::get('students/showAssist/{id}',[StudentController::class, 'find'])->name("Assist");

Route::get('Parametros',function(){ return view('parameters'); })->name('parametros');


Route::get('test', [AssistController::class, 'status'])->name('parame');
