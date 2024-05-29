<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Assist;
use Illuminate\Http\Request;
use Psy\CodeCleaner\AssignThisVariablePass;

class AssistController extends Controller
{
    /**
     * La función `assistCount` toma un objeto `Student` como entrada y devuelve el recuento de
     * asistencias asociadas con ese estudiante.
     * 
     * @param Student La función `assistCount` toma un objeto `Student` como parámetro y
     * calcula el número de asistencias asociadas con ese estudiante. Recupera el recuento de
     * asistencias de la relación "asistencias" del modelo "Estudiante" y devuelve ese recuento.
     * 
     * @return La función `assistCount` devuelve el recuento de asistencias para el objeto `Student`
     * dado.
     */
    public function assistCount(Student $student)
    {
        $assistCount = $student->assists->count();
        return $assistCount;
    }

    /**
     * La función calcula el estado de los estudiantes en función del número de asistencias que tienen
     * y parámetros predefinidos, actualizando y devolviendo el estado de los estudiantes.
     * 
     * @return La función `status()` devuelve una colección de todos los estudiantes con su estado
     * actualizado según la cantidad de asistencias que han comparado con los parámetros establecidos
     * para la promoción y el estado regular. El estado puede ser "Promocional", "Regular" o "Libre"
     * según el porcentaje calculado.
     */
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


    /**
     * La función `showSearchForm` devuelve una vista para mostrar un formulario de búsqueda en una
     * aplicación PHP.
     * 
     * @return La función `showSearchForm` devuelve una vista llamada 'searchForm'.
     */
    public function showSearchForm()
    {
        return view('searchForm');
    }

    /**
     * La función busca estudiantes según una consulta de búsqueda y devuelve los resultados a una
     * vista.
     * 
     * @param Request request El parámetro `Request ` en la función `search` es una instancia
     * de la clase `Illuminate\Http\Request` en Laravel. Representa una solicitud HTTP y le permite
     * acceder a datos de entrada, archivos, cookies y más desde la solicitud.
     * 
     * @return El método "búsqueda" en el controlador devuelve una vista llamada "búsqueda" con las
     * variables "búsqueda" y "estudiantes" compactadas. La variable "búsqueda" se usa para almacenar
     * la consulta de búsqueda ingresada por el usuario, y la variable "estudiantes" se usa para
     * almacenar los resultados de búsqueda recuperados de la base de datos en función de la consulta
     * de búsqueda.
     */
    public function search(Request $request)
    {                                       
        $search = $request->input('search'); // ->input('name') | name:"name" |
        $students = null;
        if ($search) {
            $students = Student::search($search)->orderBy('id','asc')->get();
            if($students->isEmpty()){ //isEmpty() verifica si la coleccion esta vacia
                $search = true;
            }
        }
        return view('assist/search', compact('search', 'students'));
    }

    /**
     * La función `saveAssist` verifica si un estudiante ya ha marcado la asistencia para el día actual
     * y, en caso contrario, agrega un nuevo registro de asistencia.
     * 
     * @param id La función "saveAssist" que proporcionó parece ser parte de un sistema que maneja la
     * asistencia de los estudiantes. En esta función verifica si ya existe un registro de asistencia
     * para el día actual de un estudiante específico. Si no lo hay, crea un nuevo registro de
     * asistencia para ese estudiante.
     * 
     * @return una respuesta de redireccionamiento a la ruta 'Asistencias' con un mensaje de éxito si
     * se agrega exitosamente un nuevo registro de asistencia para el estudiante con la identificación
     * proporcionada. Si ya existe un registro de asistencia para la fecha actual, devolverá una
     * respuesta de redireccionamiento con un mensaje de error indicando que ya existe un registro de
     * asistencia para hoy.
     */
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
}
