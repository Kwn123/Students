<?php

use App\Http\Controllers\ParametersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('parameterStore', [ParametersController::class, 'store'])->name('parameterStore');