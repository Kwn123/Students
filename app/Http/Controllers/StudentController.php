<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;

class StudentController extends Controller
{
    public function index()
    {
        AssistController::status();
        $students = Student::all();
        $date = date('m-d');
        $dateYear = date('Y');
        $birthdayStudent = [];
        $i = 0;
        foreach ($students as $student) {
            if ($date == date('m-d',strtotime($student->birthday))) {
                $i++;
                $birthdayStudent[$i] = $student->name . " " . $student->last_name;
                $age = $dateYear - date('Y',strtotime($student->birthday));
            }
        }
        if ($birthdayStudent) {
            $students = Student::paginate(10);
            return view('students.index', compact('students', 'birthdayStudent','age'));
        } else {
            $students = Student::paginate(10);
            return view('students.index', compact('students'));
        }
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(StoreStudentRequest $request)
    {
        $year = date('Y');
        $yearStudent = date('Y', strtotime($request->birthday));
        if (($year - $yearStudent) >= 17) {
            Student::create($request->all());
            return redirect()->route('students.index')
                ->withSuccess('Nuevo estudiante agregado con exito.');
        } else {
            return redirect()->route('students.create')
                ->with('Error', 'Estudiante menor de edad.');
        }
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

        return view('assist/showAssist', compact('cant'));
    }

    public function show(Student $student)
    {
        $assistCount = $student->assists->count();
        $fecha = $student->birthday;
        $fechaCorrecta = date('m/d/Y', strtotime($fecha));

        return view('students.show', compact('student', 'fechaCorrecta', 'assistCount'));
    }
}
