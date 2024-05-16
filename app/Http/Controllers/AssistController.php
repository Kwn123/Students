<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Assist;
use Illuminate\Http\Request;
use Psy\CodeCleaner\AssignThisVariablePass;

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


    public function showSearchForm()
    {
        return view('searchForm');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $students = null;

        if ($search) {
            $students = Student::search($search)->orderBy('id','asc')->get();
            if($students->isEmpty()){
                $search = true;
            }
        }
        return view('assist/search', compact('search', 'students'));
    }

    public function saveAssist($id){
        $dateDay=date('Y-m-d');
        $student = Student::find($id);
        $asistencias = $student->assists;
        foreach ($asistencias as $asis) {
            $date = $asis->created_at->format('Y-m-d');
            if($date === $dateDay){
                return redirect('Asistencias')->withErrors('Ya hay una asistencia de hoy.');
            };
        }
        $assist = new Assist;
        $assist->student_id = $id;
        $assist->save();

        return redirect('Asistencias')->withSuccess('Asistencia agregada con exito.');
    }

    public function showEdit($id){
        $assist = Assist::find($id);
        return view('Assist/showEdit',compact('assist'));
    }
    public function showEditUpdate(Request $request){  
        $Assit = Assist::find($request->id);
        $Assit->update($request->save());
        return redirect('students')->withSuccess('Asistencia modificada con exito.');
    }
}
