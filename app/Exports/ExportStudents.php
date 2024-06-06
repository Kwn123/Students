<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportStudents implements FromCollection
{
    protected $grade;

    public function __construct($grade)
    {
        $this->grade = $grade;
    }

    public function collection()
    {
        $students = Student::query();

        if (is_numeric($this->grade)) {
            $students = $students->get();
        } else {
            $students = $students->where('grade', $this->grade)->get();
        }

        $students->transform(function ($student) {
            unset($student['created_at']);
            unset($student['updated_at']);
            return $student;
        });

        return $students;
    }
}

