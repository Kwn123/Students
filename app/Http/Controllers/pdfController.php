<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

/* La clase pdfController en PHP genera un archivo PDF que contiene información del estudiante según la
calificación proporcionada y permite la selección de un archivo PDF a través de una vista. */
class pdfController extends Controller
{
    /**
     * La función genera un archivo PDF que contiene información del estudiante según la calificación
     * proporcionada en la solicitud.
     * 
     * @param Request request La función "pdf" en el fragmento de código es un método de controlador
     * que genera un archivo PDF que contiene información del estudiante según la calificación
     * proporcionada en la solicitud. Aquí hay un desglose del código:
     * 
     * @return Se devuelve un archivo PDF como respuesta. El PDF se genera utilizando los datos de la
     * colección `` y la vista `pdfView`. El PDF se transmite de nuevo al navegador del
     * usuario para verlo o descargarlo.
     */
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

    /**
     * La función de parámetrosPdf devuelve una vista para seleccionar un archivo PDF.
     * 
     * @return Se devuelve una vista denominada 'pdfSelect'.
     */
    public function parametersPdf()
    {
        return view('pdfSelect');
    }
}
