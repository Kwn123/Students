<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Pagination\Paginator;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;

class StudentController extends Controller
{
    public function index()
    {
        AssistController::status();
        $students = Student::paginate(10);
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(StoreStudentRequest $request)
    {
        Student::create($request->all());
        return redirect()->route('students.index')
            ->withSuccess('Nuevo estudiante agregado con exito.');
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(UpdateStudentRequest $request, student $student)
    {
        $student->update($request->all());
        return redirect()->back()
            ->withSuccess('Estudiante modificado con exito.');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')
            ->withSuccess('El estudiante fue eliminado con exito.');
    }


    public function find($id)
    {
        $student = Student::find($id);
        $cant = $student->assists;

        return view('students/showAssist', compact('cant'));
    }

    public function show(Student $student)
    {
        $assistCount = (new AssistController())->assistCount($student);
        $fecha = $student->birthday;
        $fechaCorrecta = date('m/d/Y', strtotime($fecha));

        return view('students.show', compact('student', 'fechaCorrecta', 'assistCount'));
    }
}
