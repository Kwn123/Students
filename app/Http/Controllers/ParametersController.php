<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parameters;

class ParametersController extends Controller
{
    public function store(request $request){

        if (Parameters::count() > 0){
            Parameters::truncate();
        }
        Parameters::create($request->all());
         
        return redirect()->route('students.index')
                ->withSuccess('Parametros establecidos.');
    }

    public static function getParameters($id){
        $parameters = Parameters::find($id);

        return $parameters;
    }
}
