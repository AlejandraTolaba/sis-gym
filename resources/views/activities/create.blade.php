@extends('layouts.admin')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-8 col-md-12 offset-md-2" id="accordion">
                <div class="card card-success card-outline">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h4>Nueva Actividad</h4>
                            </div>
                        </div>
                    </div>
                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
                            <form  action="{{ route('activities.store') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Nombre</label>
                                        <input class="form-control bg-ligth shadow-sm @if($errors->first('name')) is-invalid @endif"
                                        id="title"
                                        type="text"
                                        name="name"
                                        placeholder="Ingrese nombre de la actividad"
                                        value="{{old('name')}}">
                                            <span class="invalid-feedback" role="alert">
                                                <strong> {{ $errors->first('name', ':message') }} </strong>
                                            </span>
                                    </div>

                                    <label for="">Elija los planes de la actividad e ingrese precio: </label>

                                    <div class="form-row align-items-center">
                                        @foreach ($plans as $plan)
                                            <div class="col-md-4 offset-md-2 text-center">
                                                <div class="form-check mb-2">          
                                                    <input class="form-check-input" type="checkbox" id="checkbox-{{$plan->id}}" name="checkbox-{{$plan->id}}" value="{{ $plan->id }}">
                                                    <label class="form-check-label" for="checkbox-{{$plan->id}}">
                                                    {{ $plan->name }}
                                                    </label>               
                                                </div>
                                            </div>
                                            <div class="col-md-3 mr-auto">
                                                <label class="sr-only" for="inlineFormInputGroup">Precio</label>
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">$</div>
                                                    </div>
                                                    <input type="number" step = "any" class="form-control" id="price" name="price-{{$plan->id}}" id="inlineFormInputGroup">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>                 
                                </div>
                                <div class="row mt-5">
                                    <div class="col-md-12 text-center mt-3">
                                        <!-- <a href="{{ URL::previous() }}" class="btn btn-secondary">Cancelar</a> -->
                                        <a href="{{ route('activities.index') }}" class="btn btn-secondary">Cancelar</a>
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </div>
                                </div>
                                <!-- /.card-body -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection