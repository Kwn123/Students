@extends('students.layouts')

@section('content')

<div class="row justify-content-center mt-3">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Añadir parametros clases
                </div>
                <div class="float-end">
                    <a href="{{ route('students.index') }}" class="btn btn-primary btn-sm">&larr; Atras</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('parameterStore') }}" method="post">
                    @csrf

                    <div class="mb-3 row">
                        <label for="total" class="col-md-4 col-form-label text-md-end text-start">Total de clases:</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('total') is-invalid @enderror" id="total" name="total" value="{{ $parameters->total }}">
                            @if ($errors->has('total'))
                                <span class="text-danger">{{ $errors->first('total') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="promotion" class="col-md-4 col-form-label text-md-end text-start">Cantidad de clases para promocionar:</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('promotion') is-invalid @enderror" id="promotion" name="promotion" value="{{ $parameters->promotion }}">
                            @if ($errors->has('promotion'))
                                <span class="text-danger">{{ $errors->first('promotion') }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="regular" class="col-md-4 col-form-label text-md-end text-start">Cantidad de clases para quedar regular:</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('regular') is-invalid @enderror" id="regular" name="regular" value="{{ $parameters->regular }}">
                            @if ($errors->has('regular'))
                                <span class="text-danger">{{ $errors->first('regular') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Añadir parametros">
                    </div>
                    
                </form>
            </div>
        </div>
    </div>    
</div>
    
@endsection