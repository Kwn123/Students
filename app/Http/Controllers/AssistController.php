<?php

namespace App\Http\Controllers;

use App\Models\Student;

class AssistController extends Controller
{
    public function assistCount(Student $student)
    {
        $assistCount = $student->assists->count();
        return $assistCount;
    }

    public static function status(){
        $students = Student::all();
        $parameters = ParametersController::getParameters(1);
        
        if($parameters) {
            foreach($students as $student) {
                $assistCount = $student->assists->count();
                $status = ($assistCount / $parameters->total)*100;
                
                if($status >= $parameters->promotion){
                    $status = "Promocional";
                } else if($status >= $parameters->regular){
                    $status = "Regular";
                } else {
                    $status = "Libre";
                }
    
                $student->status = $status;
                $student->save();
            }
        }
        
        return $students;
    }

  
}
