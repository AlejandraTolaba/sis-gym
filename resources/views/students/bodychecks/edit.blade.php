@extends('layouts.admin')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-8 offset-md-2" id="accordion">
                <div class="card card-success card-outline">
                    <!-- <a class="d-block w-100" data-toggle="collapse" href="#collapseOne"> -->
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12 card-title text-center">
                                <h4>Editar ficha de control corporal</h4>
                            </div>
                        </div>
                    </div>
                    <!-- </a> -->
                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
                            <form  action="{{ route('bodychecks.update', $bodycheck->id) }}" method="POST">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="weight">Peso</label>
                                            <input 
                                                type="number" 
                                                step="any" name="weight" 
                                                class="form-control bg-ligth shadow-sm @if($errors->first('weight')) is-invalid @endif" 
                                                id="weight" 
                                                placeholder="Ingrese peso"
                                                value="{{old('weight',$bodycheck->weight)}}">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong> {{ $errors->first('weight', ':message') }} </strong>
                                                </span>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="imc">IMC</label>
                                            <input 
                                                type="number" 
                                                step="any" 
                                                name="imc" 
                                                class="form-control bg-ligth shadow-sm @if($errors->first('imc')) is-invalid @endif" 
                                                id="imc" 
                                                placeholder="Ingrese IMC"
                                                value="{{old('imc',$bodycheck->imc)}}">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong> {{ $errors->first('imc', ':message') }} </strong>
                                                </span>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="body_age">Edad Corporal</label>
                                            <input 
                                                type="number" 
                                                name="body_age" 
                                                class="form-control bg-ligth shadow-sm @if($errors->first('body_age')) is-invalid @endif" 
                                                id="body_age" 
                                                placeholder="Ingrese edad corporal"
                                                value="{{old('body_age',$bodycheck->body_age)}}">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong> {{ $errors->first('body_age', ':message') }} </strong>
                                                </span>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="body_fat">Grasa corporal</label>
                                            <input 
                                                type="number" 
                                                step="any" name="body_fat" 
                                                class="form-control bg-ligth shadow-sm @if($errors->first('body_fat')) is-invalid @endif" 
                                                id="body_fat" 
                                                placeholder="Ingrese peso"
                                                value="{{old('body_fat',$bodycheck->body_fat)}}">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong> {{ $errors->first('body_fat', ':message') }} </strong>
                                                </span>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="imm">IMM</label>
                                            <input 
                                                type="number" 
                                                step="any" 
                                                name="imm" 
                                                class="form-control bg-ligth shadow-sm @if($errors->first('imm')) is-invalid @endif" 
                                                id="imm" 
                                                placeholder="Ingrese IMM"
                                                value="{{old('imm',$bodycheck->imm)}}">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong> {{ $errors->first('imm', ':message') }} </strong>
                                                </span>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="mb">MB</label>
                                            <input 
                                                type="number" 
                                                name="mb" 
                                                class="form-control bg-ligth shadow-sm @if($errors->first('mb')) is-invalid @endif" 
                                                id="mb" 
                                                placeholder="Ingrese edad corporal"
                                                value="{{old('mb',$bodycheck->mb)}}">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong> {{ $errors->first('mb', ':message') }} </strong>
                                                </span>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4 offset-md-4">
                                            <label for="visceral_fat">Grasa visceral</label>
                                            <input 
                                                type="number" 
                                                step="any" name="visceral_fat" 
                                                class="form-control bg-ligth shadow-sm @if($errors->first('visceral_fat')) is-invalid @endif" 
                                                id="visceral_fat" 
                                                placeholder="Ingrese peso"
                                                value="{{old('visceral_fat',$bodycheck->visceral_fat)}}">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong> {{ $errors->first('visceral_fat', ':message') }} </strong>
                                                </span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center mt-3">
                                            <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancelar</a>
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
