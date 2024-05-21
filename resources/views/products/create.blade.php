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
                                <h4>Nuevo producto</h4>
                            </div>
                        </div>
                    </div>
                    <!-- </a> -->
                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
                            <form  action="{{ route('products.store') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-5">
                                            <label for="code">Código</label>
                                            <input 
                                                type="number" 
                                                name="code" 
                                                class="form-control bg-ligth shadow-sm @if($errors->first('code')) is-invalid @endif" 
                                                id="code" 
                                                placeholder="Ingrese código"
                                                value="{{ (old('code')) }}">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong> {{ $errors->first('code', ':message') }} </strong>
                                                </span>
                                        </div>
                                        <div class="form-group col-md-7">
                                            <label for="name">Nombre</label>
                                            <input 
                                                type="text" 
                                                name="name" 
                                                class="form-control bg-ligth shadow-sm @if($errors->first('name')) is-invalid @endif" 
                                                id="name" 
                                                placeholder="Ingrese nombre"
                                                value="{{old('name')}}">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong> {{ $errors->first('name', ':message') }} </strong>
                                                </span>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-5">
                                            <label for="stock">Stock</label>
                                            <input 
                                                type="number" 
                                                name="stock" 
                                                class="form-control bg-ligth shadow-sm @if($errors->first('stock')) is-invalid @endif" 
                                                id="stock" 
                                                placeholder="Ingrese stock"
                                                value="{{ (old('stock')) }}">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong> {{ $errors->first('stock', ':message') }} </strong>
                                                </span>
                                        </div>
                                        <div class="form-group col-md-7">
                                            <label for="price">Precio</label>
                                            <input 
                                                type="number" 
                                                step="any" 
                                                name="price" 
                                                class="form-control bg-ligth shadow-sm @if($errors->first('price')) is-invalid @endif" 
                                                id="price" 
                                                placeholder="Ingrese precio"
                                                value="{{ (old('price')) }}">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong> {{ $errors->first('price', ':message') }} </strong>
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
