@extends('layouts.app')

@section('content')
    <div class="row justify-content-center mt-3">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        Elegir parametros para pdf
                    </div>
                    <div class="float-end">
                        <a href="{{ route('students.index') }}" class="btn btn-primary btn-sm">&larr; Atras</a>
                    </div>
                </div>
                @if ($message = Session::get('Error'))
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
            @endif
                <div class="card-body">
                    <form action="{{ route('download') }}" method="post">
                        @csrf
                    
                        <div class="form-group">
                            <select name="grade" class="form-control">
                                <option value="0">Todos los alumnos</option>
                                <option value="Primero">Primero</option>
                                <option value="Segundo">Segundo</option>
                                <option value="Tercero">Tercero</option>
                                <option value="Cuarto">Cuarto</option>
                                <option value="Quinto">Quinto</option>
                            </select>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" name="action" value="pdf" class="btn btn-primary mt-2 d-inline-block">Descargar PDF</button>
                            <button type="submit" name="action" value="excel" class="btn btn-secondary mt-2 d-inline-block">Descargar EXCEL</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>

@endsection
