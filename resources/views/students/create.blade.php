@extends('layouts.app')

@section('content')
    <div class="row justify-content-center mt-3">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        Añadir estudiante
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
                    <form action="{{ route('students.store', $val) }}" method="post">
                        @csrf

                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Nombre</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-end text-start">Apellido</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                    id="last_name" name="last_name" value="{{ old('last_name') }}">
                                @if ($errors->has('last_name'))
                                    <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                @endif
                            </div>
                        </div>
                        <input type="hidden" name="status" value="N/A" id="status">
                        <div class="mb-3 row">
                            <label for="dni" class="col-md-4 col-form-label text-md-end text-start">DNI</label>
                            <div class="col-md-6">
                                <input type="integer" class="form-control @error('dni') is-invalid @enderror" id="dni"
                                    name="dni" value="{{ old('dni') }}">
                                @if ($errors->has('dni'))
                                    <span class="text-danger">{{ $errors->first('dni') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="birthday" class="col-md-4 col-form-label text-md-end text-start">Fecha de
                                nacimiento</label>
                            <div class="col-md-6">
                                <input type="date" class="form-control @error('birthday') is-invalid @enderror"
                                    id="birthday" name="birthday" value="{{ old('birthday') }}">
                                @if ($errors->has('birthday'))
                                    <span class="text-danger">{{ $errors->first('birthday') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="group" class="col-md-4 col-form-label text-md-end text-start">Grupo</label>
                            <div class="col-md-6">
                                <select name="group" id="group">
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                </select>
                                @if ($errors->has('group'))
                                    <span class="text-danger">{{ $errors->first('group') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Añadir estudiante">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
