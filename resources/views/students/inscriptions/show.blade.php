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
                                <h4>Actualizar saldo</h4>
                            </div>
                        </div>
                    </div>
                    <!-- </a> -->
                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
                            <form  action="{{ route('inscriptions.show', $inscription->id) }}" method="POST">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-7">
                                        <label class="col-sm-12 col-form-label">N° de Inscripción: {{$inscription->id}}</label>
                                    </div>
                                    <div class="col-md-5">
                                        <label class="col-sm-12 col-form-label">Fecha de alta: {{ $inscription->registration_date->format('d-m-Y') }}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-7">
                                        <label class="col-sm-12 col-form-label">Alumno: {{$inscription->student->name}} {{$inscription->student->lastname}}</label>
                                    </div>
                                    <div class="col-md-5">
                                        <label class="col-sm-12 col-form-label">Actividad: {{$inscription->activity->name}}</label>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-7">
                                        <label class="col-sm-12 col-form-label">Plan: {{$inscription->plan->name}}</label>
                                    </div>
                                    <div class="col-md-5">
                                        <label class="col-sm-12 col-form-label @if ($inscription->balance > 0) text-danger @endif">Saldo: $<?=number_format($inscription->balance,2,',','.') ?></label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-7 mt-2">
                                        <select id="method_of_payment_id" name='method_of_payment_id' data-placeholder="Seleccione una forma de pago" class="form-control select2 shadow-sm @if($errors->first('method_of_payment_id')) is-invalid @endif" >
                                            <option></option>
                                            @foreach ($methods_of_payment as $method_of_paymen)
                                                <option value="{{$method_of_paymen->id}}" {{old('method_of_payment_id') == $method_of_paymen->id ? 'selected' : ''}}>{{$method_of_paymen->name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="invalid-feedback" role="alert">
                                            <strong> {{ $errors->first('method_of_payment_id', ':message') }} </strong>
                                        </span>
                                    </div>
                                    <div class="col-md-5 mt-2">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">$</div>
                                            </div>
                                            <input type="number" step = "any" id="amount" name="amount" class="form-control @if($errors->first('amount')) is-invalid @endif" placeholder="Ingrese monto a pagar">
                                            <span class="invalid-feedback" role="alert">
                                                <strong> {{ $errors->first('amount', ':message') }} </strong>
                                            </span>
                                        </div>
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
