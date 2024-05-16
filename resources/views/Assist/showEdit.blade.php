@extends('layouts.app')

@section('title', 'Asistencia')
@section('titlePag', 'Añadir asistencia')

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
                    Modificar asistencia
                </div>
                <div class="float-end">
                    <a href="{{ route('students.index') }}" class="btn btn-primary btn-sm">&larr; Atras</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{route('showEdit.update')}}" method="post">
                    @csrf
                    @method("PUT")

                    <input type="hidden" name="id" id="id" value="{{$assist->id}}">
                  <div class="mb-3 row">
                        <label for="created_at" class="col-md-4 col-form-label text-md-end text-start">Asistencia</label>
                        <div class="col-md-6">
                          <input type="datetime" class="form-control @error('created_at') is-invalid @enderror" id="created_at" name="created_at" value="{{ $assist->created_at }}">
                            @if ($errors->has('created_at'))
                                <span class="text-danger">{{ $errors->first('created_at') }}</span>
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