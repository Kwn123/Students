<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;

class StudentController extends Controller
{
    public function index()
    {
        return view('students.index', [
            'students' => Student::latest()->paginate(10)
        ]);
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
        return view('students.edit', [
            'student' => $student
        ]);
    }

    public function update(UpdateStudentRequest $request,student $student)
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
}
