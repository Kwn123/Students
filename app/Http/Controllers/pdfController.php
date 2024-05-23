<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;

class pdfController extends Controller
{
    public function pdf()
    {
        AssistController::status();
        $students = Student::all();
        foreach($students as $student){
            $student->assist = $student->assists ? $student->assists->count() : 0;
        }
        $pdf = Pdf::loadView('pdfView', compact('students'));
        return $pdf->stream();
    }
}
