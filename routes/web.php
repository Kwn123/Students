<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StudentController;
use App\Http\Controllers\AssistController;
use App\Http\Controllers\ParametersController;
use App\Http\Controllers\pdfController;


Route::get('/', function () {
    return redirect('/students');
});

Route::get('/dashboard', function () {
    return redirect('/students');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    /*students*/
    Route::resource('students', StudentController::class);
});

require __DIR__.'/auth.php';

Route::get('students/showAssist/{id}',[StudentController::class, 'find'])->name("Assist");

Route::get('Parametros',[ParametersController::class, 'edit'])->name('parametros');

Route::get('Asistencias', [AssistController::class, 'search'])->name('search');

Route::post('Asistencias/{id}',[AssistController::class, 'saveAssist'])->name('saveAssist');
Route::get('Asistencias/edit/{id}',[AssistController::class, 'showEdit'])->name('showEdit');
Route::put('Asistencias',[AssistController::class, 'showEditUpdate'])->name('showEdit.update');

Route::post('Download',[pdfController::class, 'downloadAction'])->name('download');
Route::get('parameters_pdf',[pdfController::class, 'parametersPdf'])->name('viewParamPdf');

Route::post('/save-assistance/{id}', [AssistController::class, 'saveAssistance'])->name('saveAssistance');
