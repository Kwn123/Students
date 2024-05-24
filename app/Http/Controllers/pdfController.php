<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class pdfController extends Controller
{
    public function pdf(Request $request)
    {
        AssistController::status();
        $grade = $request->input('grade');
        if (is_numeric($grade)) {
            $students = Student::all();
        } else {
            $students = Student::where('grade', $grade)->get();
        }
        foreach ($students as $student) {
            $student->assist = $student->assists ? $student->assists->count() : 0;
        }
        $pdf = Pdf::loadView('pdfView', compact('students'));
        return $pdf->stream();
    }

    public function parametersPdf()
    {
        return view('pdfSelect');
    }
}
