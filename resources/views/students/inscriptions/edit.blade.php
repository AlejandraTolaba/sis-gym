@extends('layouts.admin')

@section('content')
    @if(session('error'))
        <div class="alert alert-danger fade show col-md-6 offset-md-3" role="alert">  
            {{Session::get('error')}}
        </div>
    @endif
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-6 offset-md-3" id="accordion">
                <div class="card card-success card-outline">
                    <!-- <a class="d-block w-100" data-toggle="collapse" href="#collapseOne"> -->
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12 card-title text-center">
                                <h4>Actualizar vencimiento</h4>
                            </div>
                        </div>
                    </div>
                    <!-- </a> -->
                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
                            <form  action="{{ route('inscriptions.updateExpiration', $inscription->id) }}" method="POST">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="col-sm-12 col-form-label">N° de Inscripción: {{$inscription->id}}</label>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="col-sm-12 col-form-label">Fecha de inscripción: {{ $inscription->registration_date->format('d-m-Y') }}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="col-sm-12 col-form-label">Alumno: {{$inscription->student->name}} {{$inscription->student->lastname}}</label>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="col-sm-12 col-form-label">Actividad: {{$inscription->activity->name}}</label>
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="expiration_date" class="col-sm-12 col-form-label">Fecha de vencimiento:</label>  
                                    </div>
                                    <div class="col-md-6">                 
                                        <input class="form-control bg-ligth shadow-sm @if($errors->first('expiration_date')) is-invalid @endif"
                                        id='input_expiration_date'
                                        type ="date" 
                                        name="expiration_date" 
                                        value="{{old('expiration_date', $inscription->expiration_date->toDateString())}}">
                                            <span class="invalid-feedback" role="alert">
                                                <strong> {{ $errors->first('expiration_date', ':message') }} </strong>
                                            </span>
                                    </div>
                                </div>
                                             
                                <div class="row">
                                    <div class="col-md-12 text-center mt-3">
                                        <a href="{{ URL::previous() }}" class="btn btn-secondary">Cancelar</a>
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
