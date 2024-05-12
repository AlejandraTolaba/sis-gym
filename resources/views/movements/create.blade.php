@extends('layouts.admin')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-6 offset-md-3" id="accordion">
                <div class="card card-success card-outline">
                    <!-- <a class="d-block w-100" data-toggle="collapse" href="#collapseOne"> -->
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12 card-title text-center">
                                <h4>Nuevo Movimiento</h4>
                            </div>
                        </div>
                    </div>
                    <!-- </a> -->
                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
                            <form  action="{{ route('movements.store') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="form-row">
                                        <!-- <div class="col-md-6">
                                            <label for="date">Fecha</label>                   
                                            <input class="form-control bg-ligth shadow-sm @if($errors->first('date')) is-invalid @endif"
                                            id='input_date'
                                            type ="date" 
                                            name="date" 
                                            value="{{old('date')}}">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong> {{ $errors->first('date', ':message') }} </strong>
                                                </span>
                                        </div> -->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="type">Tipo</label>
                                                <select id="type" name='type' data-placeholder="Seleccione un tipo" class="form-control plan select2 shadow-sm @if($errors->first('type')) is-invalid @endif" >
                                                    <option></option>
                                                    <option>INGRESO</option>
                                                    <option>EGRESO</option>
                                                </select>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong> {{ $errors->first('type', ':message') }} </strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label for="concept">Concepto</label>    
                                            <input type="text"
                                                class="form-control bg-ligth shadow-sm @if($errors->first('concept')) is-invalid @endif"
                                                id='concept'
                                                type ="concept" 
                                                name="concept" 
                                                value="{{old('concept')}}"
                                                placeholder="Ingrese concepto">
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong> {{ $errors->first('concept', ':message') }} </strong>
                                                    </span>
                                        </div>
                                    </div>    
                                
                                    <div class="form-row">
                                        <div class="col-md-9 mb-3">
                                            <div class="form-group">
                                                <label for="method_of_payment_id">Forma de pago</label>
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
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="amount">Monto</label>
                                            <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">$</div>
                                                    </div>
                                                    <input type="number" 
                                                        step = "any" 
                                                        class="form-control bg-ligth shadow-sm @if($errors->first('amount')) is-invalid @endif" 
                                                        id="amount" 
                                                        name="amount"
                                                        value="{{old('amount')}}">
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong> {{ $errors->first('amount', ':message') }} </strong>
                                                        </span>
                                                </div>
                                        </div>
                                    </div>                     
                                    
                                    <div class="row">
                                        <div class="col-md-12 text-center mt-3">
                                            <a href="{{ route('movements.index') }}" class="btn btn-secondary">Cancelar</a>
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
