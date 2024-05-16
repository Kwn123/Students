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

    public static function getParameters($id){
        $parameters = Parameters::find($id);

        return $parameters;
    }
}
