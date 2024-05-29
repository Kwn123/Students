@extends('layouts.app')

@section('title', 'Editar')
@section('titlePag', 'Editar')

@section('content')

<div class="row justify-content-center mt-3">
    <div class="col-md-8">

        @if ($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{ $message }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Modificar estudiante
                </div>
                <div class="float-end">
                    <a href="{{ route('students.index') }}" class="btn btn-primary btn-sm">&larr; Atras</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('students.update', $student->id) }}" method="post">
                    @csrf
                    @method("PUT")

                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start">Nombre</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $student->name }}">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="last_name" class="col-md-4 col-form-label text-md-end text-start">Apellido</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ $student->last_name }}">
                            @if ($errors->has('last_name'))
                                <span class="text-danger">{{ $errors->first('last_name') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="dni" class="col-md-4 col-form-label text-md-end text-start">DNI</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('dni') is-invalid @enderror" id="dni" name="dni" value="{{ $student->dni }}">
                            @if ($errors->has('dni'))
                                <span class="text-danger">{{ $errors->first('dni') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="birthday" class="col-md-4 col-form-label text-md-end text-start">Fecha de nacimiento</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('birthday') is-invalid @enderror" id="birthday" name="birthday" value="{{ $student->birthday}}">
                            @if ($errors->has('birthday'))
                                <span class="text-danger">{{ $errors->first('birthday') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="group" class="col-md-4 col-form-label text-md-end text-start">Grupo</label>
                        <div class="col-md-6">
                            <select name="group">
                                <option value="A" {{ $student->group === 'A' ? 'selected' : '' }}>A</option>
                                <option value="B" {{ $student->group === 'B' ? 'selected' : '' }}>B</option>
                            </select></label>
                            @if ($errors->has('group'))
                                <span class="text-danger">{{ $errors->first('group') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="grade" class="col-md-4 col-form-label text-md-end text-start">Grado</label>
                        <div class="col-md-6">
                            <select name="grade">
                                <option value="Primero" {{ $student->grade === 'Primero' ? 'selected' : '' }}>Primero</option>
                                <option value="Segundo" {{ $student->grade === 'Segundo' ? 'selected' : '' }}>Segundo</option>
                                <option value="Tercero" {{ $student->grade === 'Tercero' ? 'selected' : '' }}>Tercero</option>
                                <option value="Cuarto" {{ $student->grade === 'Cuarto' ? 'selected' : '' }}>Cuarto</option>
                                <option value="Quinto" {{ $student->grade === 'Quinto' ? 'selected' : '' }}>Quinto</option>
                            </select></label>
                            @if ($errors->has('grade'))
                                <span class="text-danger">{{ $errors->first('grade') }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Modificar">
                    </div>
                    
                </form>
            </div>
        </div>
    </div>    
</div>
    
@endsection