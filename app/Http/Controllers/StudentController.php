<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;

/* La clase `StudentController` en PHP administra los datos de los estudiantes, incluida la
visualización de sus cumpleaños, la creación, actualización y eliminación de registros de
estudiantes y el manejo de la información de asistencia de los estudiantes. */
class StudentController extends Controller
{
    /**
     * La función de índice comprueba si es el cumpleaños de un estudiante y muestra una lista paginada
     * de estudiantes en consecuencia.
     * 
     * @return El método `index` devuelve una vista llamada 'students.index' con los datos que se le
     * pasan. Si es el cumpleaños de un estudiante, la vista se devuelve con la lista de estudiantes
     * paginados por 10 y la variable ``. Si no es el cumpleaños de un estudiante, la
     * vista se devuelve solo con la lista de estudiantes paginados por 10.
     */
    public function index()
    {
        AssistController::status();
        $dateBirthday = $this->isBirthday();
        if ($dateBirthday) {
            $students = Student::paginate(10);
            return view('students.index', compact('students', 'dateBirthday'));
        } else {
            $students = Student::paginate(10);
            return view('students.index', compact('students'));
        }
    }

    /**
     * La función `isBirthday` comprueba si algún estudiante cumple años hoy y devuelve una serie de
     * nombres y edades de los estudiantes si es así.
     * 
     * @return La función `isBirthday` devuelve una matriz que contiene los nombres y edades de los
     * estudiantes cuyo cumpleaños coincide con la fecha actual (mes y día). Cada elemento de la matriz
     * es una matriz en sí misma que contiene el nombre y la edad de un estudiante que cumple años en
     * la fecha actual.
     */
    public static function isBirthday(){
        $students = Student::all();
        $date = date('m-d');
        $dateYear = date('Y');
        $dateBirthday=[];
        $i = 0;
        foreach ($students as $student) {
            if ($date == date('m-d',strtotime($student->birthday))) {
                $i++;
                $birthdayStudent = $student->name . " " . $student->last_name;
                $age = $dateYear - date('Y',strtotime($student->birthday));
                $dateBirthday[$i] = [$birthdayStudent, $age];
            }
        }
        return $dateBirthday;
    }

 /**
  * La función de creación devuelve una vista para crear un nuevo estudiante.
  * 
  * @return Se devuelve una vista denominada 'students.create'.
  */
    public function create()
    {
        return view('students.create');
    }

    /**
     * La función "almacenar" verifica si un estudiante tiene más de cierta edad antes de crear un
     * nuevo registro de estudiante.
     * 
     * @param StoreStudentRequest request La función "almacenar" en el fragmento de código es
     * responsable de almacenar un nuevo registro de estudiante en la base de datos. Primero verifica
     * si el estudiante tiene más de cierta edad llamando al método `isOlder` con el cumpleaños del
     * estudiante como parámetro. Si el estudiante es mayor, un nuevo `
     * 
     * @return Si el estudiante es mayor, se crea un nuevo registro de estudiante y se redirige al
     * usuario a la ruta 'students.index' con un mensaje de éxito. Si el estudiante no es mayor, el
     * usuario es redirigido a la ruta 'students.create' con un mensaje de error que indica que el
     * estudiante es menor de edad.
     */
    public function store(StoreStudentRequest $request)
    {
        $isOlder = $this->isOlder($request->birthday);
        if ($isOlder) {
            Student::create($request->all());
            return redirect()->route('students.index')
                ->withSuccess('Nuevo estudiante agregado con exito.');
        } else {
            return redirect()->route('students.create')
                ->with('Error', 'Estudiante menor de edad.');
        }
    }

    /**
     * La función `isOlder` determina si una persona es mayor de 17 años según su fecha de nacimiento.
     * 
     * @param birthday La función `isOlder` que proporcionó verifica si una persona es mayor de 17 años
     * según su fecha de nacimiento. Para utilizar esta función, debe pasar el cumpleaños de la persona
     * en el formato 'AAAA-MM-DD'.
     * 
     * @return La función isOlder verifica si una persona tiene más de 17 años según su fecha de
     * nacimiento. Si la persona tiene más de 17 años, la función devolverá verdadero. Si la persona
     * tiene 17 años o menos, la función devolverá falso.
     */
    public function isOlder($birthday){
        $yearStudent = date('Y', strtotime($birthday));
        $year = date('Y');
        $yearTotal = $year - $yearStudent;
        if($yearTotal < 17){
            return false;
        }else{
            return true;
        }
    }

    /**
     * La función de edición en PHP toma un objeto Estudiante como parámetro y devuelve una vista para
     * editar la información de ese estudiante.
     * 
     * @param Student student La función `editar` es un método de controlador que toma un objeto
     * `Estudiante` como parámetro. Este método es responsable de mostrar el formulario de edición para
     * un estudiante específico. La función `compact('student')` se utiliza para pasar el objeto de
     * estudiante a la vista para que se pueda acceder a él y mostrarlo.
     * 
     * @return Se devuelve una vista denominada 'students.edit' con los datos de los estudiantes
     * pasados como una variable compacta.
     */
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    /**
     * La función actualiza el registro de un estudiante en función de los datos proporcionados en la
     * solicitud y lo redirecciona con un mensaje de éxito.
     * 
     * @param UpdateStudentRequest request El parámetro `` en la función `update` es una
     * instancia de la clase `UpdateStudentRequest`. Es probable que esta clase contenga reglas de
     * validación y lógica para validar y procesar los datos de la solicitud entrante antes de
     * actualizar el registro del estudiante.
     * @param student student El parámetro "estudiante" en la función "actualizar" representa la
     * instancia del modelo de un registro de estudiante que desea actualizar. Este parámetro se
     * utiliza para identificar el registro de estudiante específico que debe actualizarse en la base
     * de datos.
     * 
     * @return La función `actualizar` devuelve una redirección a la página anterior con un mensaje de
     * éxito "Estudiante modificado con éxito".
     */
    public function update(UpdateStudentRequest $request, student $student)
    {
        $student->update($request->all());
        return redirect()->back()
            ->withSuccess('Estudiante modificado con exito.');
    }

    /**
     * La función elimina el registro de un estudiante y lo redirige a la página de índice con un
     * mensaje de éxito.
     * 
     * @param Student student La función "destruir" es un método que elimina un registro "Estudiante"
     * específico de la base de datos. El parámetro `` es una instancia del modelo `Student`
     * que representa el registro del estudiante que se eliminará.
     * 
     * @return La función `destroy` devuelve una respuesta de redireccionamiento a la ruta denominada
     * 'students.index' con un mensaje de éxito 'El estudiante fue eliminado con éxito'.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')
            ->withSuccess('El estudiante fue eliminado con exito.');
    }


    
    /**
     * La función de búsqueda recupera la información de un estudiante y pasa la cantidad de
     * asistencias a la vista showAssist.
     * 
     * @param id La función "buscar" se utiliza para recuperar un registro de estudiante específico de
     * la base de datos según el "" proporcionado. En este caso, la función busca un registro de
     * estudiante con el "" dado y luego accede a la propiedad "asistencias" de ese estudiante.
     * 
     * @return La función `find` devuelve una vista llamada 'assist/showAssist' con la variable ``
     * pasada usando la función `compact`. El valor de `` es el número de asistencias asociadas
     * con el estudiante con el `` dado.
     */
    public function find($id)
    {
        $student = Student::find($id);
        $cant = $student->assists;

        return view('assist/showAssist', compact('cant'));
    }

    /**
     * La función "mostrar" toma un objeto Estudiante como parámetro, recupera el número de asistencias
     * y la fecha de cumpleaños del estudiante, formatea la fecha de cumpleaños y devuelve una vista
     * con los datos del estudiante.
     * 
     * @param Student student La función `show` toma un objeto `Student` como parámetro. Esta función
     * se encarga de mostrar información sobre el estudiante, como su cumpleaños, número de asistencias
     * y otros detalles. El objeto "Estudiante" probablemente contenga propiedades y métodos
     * relacionados con la información de un estudiante, como su nombre.
     * 
     * @return La función `show` devuelve una vista llamada `students.show` y pasa tres variables a la
     * vista: `student`, `fechaCorrecta` y `assistCount`.
     */
    public function show(Student $student)
    {
        $assistCount = $student->assists->count();
        $fecha = $student->birthday;
        $fechaCorrecta = date('m/d/Y', strtotime($fecha));

        return view('students.show', compact('student', 'fechaCorrecta', 'assistCount'));
    }

}
