@extends('layouts.app')

@section('title', 'Asistencia')
@section('titlePag', 'Añadir asistencia')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{ route('search') }}" method="get" class="text-center mt-4 mb-4">
                    <div class="mb-3 text-center">
                        <input type="text" class="form-control text-center mx-auto" style="width: 40%" name="search"
                            placeholder="Ingrese su búsqueda" value="{{ $search }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </form>
            </div>
        </div>
    </div>
    <div class="container" style="width: 100%">
        @if ($message = Session::get('success'))
            <div class="alert alert-success text-center mx-auto" role="alert">
                {{ $message }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger text-center mx-auto" style="width: 50%;">
                {{ $errors->first() }}
            </div>
        @endif
        @if ($students == null)
        @else
            @if ($search === true)
                <div class="alert alert-danger text-center mx-auto" role="alert" style="width: 50%;">
                    <h1>No se encontraron coincidencias</h1>
                </div>
            @else
                <div class="card">
                    <div class="card-header text-center">Lista de búsqueda</div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Apellido</th>
                                    <th scope="col">DNI</th>
                                    <th scope="col">Fecha de nacimiento</th>
                                    <th scope="col">Año</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                    <tr>
                                        <th scope="row" style="height: 50px; text-align:center">{{ $student->id }}</th>
                                        <td>{{ $student->name }}</td>
                                        <td>{{ $student->last_name }}</td>
                                        <td>{{ $student->dni }}</td>
                                        <td>{{ $student->birthday }}</td>
                                        <td>{{ $student->grade }}</td>
                                        <td>{{ $student->status }}</td>
                                        <td style="width: 400px;">
                                            <form action="{{ route('saveAssist', $student->id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">Añadir asistencia</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        @endif
    </div>
@endsection
