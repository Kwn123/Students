@extends('students.layouts')

@section('title','Asistencias')
@section('titlePag', 'ASISTENCIAS')
@section('content')

<div class="row justify-content-center mt-3">
    <div class="col-md-12">

        @if ($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{ $message }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">Lista de estudiantes</div>
            <div class="card-body">
                                <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">ID Estudiante</th>
                        <th scope="col">Ingreso</th>
                        <th scope="col">Egreso?</th>
                      </tr>
                    </thead>
                    <tbody>
                        @forelse ($cant as $assit)
                        <tr>
                            <th scope="row">{{ $assit->id}}</th>
                            <td>{{ $assit->student_id}}</td>
                            <td>{{ $assit->created_at }}</td>
                            <td>{{ $assit->updated_at }}</td>
                        </tr>
                        @empty
                            <td colspan="6">
                                <span class="text-danger">
                                    <strong>No hay asistencias!</strong>
                                </span>
                            </td>
                        @endforelse
                    </tbody>
                  </table>
            </div>
        </div>
    </div>    
</div>
    
@endsection
