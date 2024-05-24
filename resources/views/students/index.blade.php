@extends('layouts.app')

@section('title', 'Estudiantes')
@section('titlePag', 'ESTUDIANTES')
@section('content')

    <div class="row justify-content-center mt-3">
        <div class="col-md-12">

            @if ($message = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    {{ $message }}
                </div>
            @endif

            @if (@isset($birthdayStudent))
                <div class="alert alert-success" role="alert">
                    @foreach ($birthdayStudent as $student)
                        <h1>Feliz cumpleaños {{ $student }} hoy cumple {{$age}}!</h1>
                    @endforeach
                </div>
            @endif
            <div class="card">
                <div class="card-header">Lista de estudiantes</div>
                <div class="card-body">
                    <div class="flex justify-between">
                        <a href="{{ route('students.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Añadir estudiante</a>
                        <a href="{{ route('viewParamPdf') }}" class="btn btn-secondary btn-sm my-2 no-hover"><i class="bi bi-eye"></i> Imprimir informe</a>
                    </div>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Apellido</th>
                                <th scope="col">DNI</th>
                                <th scope="col">Fecha de nacimiento</th>
                                <th scope="col">Año</th>
                                <th scope="col">Grupo</th>
                                <th scope="col">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($students as $student)
                                <tr>
                                    <th scope="row" style="height: 50px; text-aling:center">{{ $student->id }} </th>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->last_name }}</td>
                                    <td>{{ $student->dni }}</td>
                                    <td>{{ $fecha = date('d-m-Y', strtotime($student->birthday)) }}</td>
                                    <td>{{ $student->grade }}</td>
                                    <td>{{ $student->group }}</td>
                                    <td>{{ $student->status }}</td>
                                    <td style="width: 400px;">
                                        <form action="{{ route('students.destroy', $student->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')

                                            <a href="{{ route('students.show', $student->id) }}"
                                                class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Info</a>
                                            <a href="{{ route('Assist', $student->id) }}" class="btn btn-info btn-sm"><i
                                                    class="bi bi-eye"></i> Asistencia</a>
                                            <a href="{{ route('students.edit', $student->id) }}"
                                                class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i>
                                                Modificar</a>

                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Seguro que quiere eliminar al alumno?');"><i
                                                    class="bi bi-trash"></i> Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <td colspan="6">
                                    <span class="text-danger">
                                        <strong>No hay estudiantes!</strong>
                                    </span>
                                </td>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $students->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
