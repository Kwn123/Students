<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parameters;

class ParametersController extends Controller
{
    /**
     * La función de almacenamiento borra los parámetros existentes y crea otros nuevos basados en los
     * datos de la solicitud antes de redirigir a la página de índice de los estudiantes con un mensaje
     * de éxito.
     * 
     * @param request request La función "almacenar" en el fragmento de código se utiliza para
     * almacenar parámetros en la base de datos. Primero verifica si hay parámetros existentes en el
     * modelo "Parámetros". Si los hay, los trunca (elimina todos los registros). Luego, crea nuevos
     * parámetros utilizando los datos del
     * 
     * @return La función `store` está devolviendo una respuesta de redireccionamiento a la ruta
     * `students.index` con un mensaje de éxito "Parametros establecidos".
     */
    public function store(request $request){
        if (Parameters::count() > 0){
            Parameters::truncate();
        }
        Parameters::create($request->all());
         
        return redirect()->route('students.index')
                ->withSuccess('Parametros establecidos.');
    }

   /**
    * La función de edición recupera parámetros de la base de datos, crea nuevos parámetros si no
    * existen y luego devuelve una vista con los parámetros.
    * 
    * @return La función `edit()` devuelve una vista llamada 'parámetros' con los datos de la variable
    * `parameters` que se le pasan usando la función `compact()`. La variable `parámetros` contiene los
    * datos obtenidos de la base de datos para el modelo de Parámetros con un ID de 1.
    */
    public function edit(){
        $parameters = Parameters::first();
        if (!$parameters) {
            $parameters = new Parameters();
            $parameters->total = 0;
            $parameters->promotion = 0;
            $parameters->regular = 0;
            $parameters->save();
        }
       $parameters = Parameters::find(1);
        return view('parameters', compact('parameters'));
    }

    /**
     * La función `getParameters` recupera parámetros según la ID proporcionada usando PHP.
     * 
     * @param id Parece que está intentando recuperar parámetros basados en una ID mediante una función
     * estática. Para hacerlo, puede llamar a la función `getParameters` y pasar el ID como parámetro.
     * Luego, la función utilizará el ID para buscar y devolver los parámetros correspondientes.
     * 
     * @return La función `getParameters` devuelve los parámetros encontrados en la base de datos según
     * el `` proporcionado.
     */
    public static function getParameters($id){
        $parameters = Parameters::find($id);
        return $parameters;
    }
}
