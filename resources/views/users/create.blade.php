@extends('layouts.admin')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-6 offset-md-3" id="accordion">
                <div class="card card-success card-outline">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h4>Nuevo Usuario</h4>
                            </div>
                        </div>
                    </div>
                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
                            <form  action="{{ route('users.store') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Nombre</label>
                                        <input 
                                            type="text" 
                                            name="name" 
                                            class="form-control bg-ligth shadow-sm @if($errors->first('name')) is-invalid @endif" 
                                            id="name" 
                                            placeholder="Ingrese nombre"
                                            value="{{ (old('name')) }}">
                                            <span class="invalid-feedback" role="alert">
                                                <strong> {{ $errors->first('name', ':message') }} </strong>
                                            </span>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input 
                                            type="email" 
                                            name="email" 
                                            class="form-control bg-ligth shadow-sm @if($errors->first('email')) is-invalid @endif" 
                                            id="email" 
                                            placeholder="example@gmail.com"
                                            value="{{ (old('email')) }}">
                                            <span class="invalid-feedback" role="alert">
                                                <strong> {{ $errors->first('email', ':message') }} </strong>
                                            </span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tipo</label>
                                        <div class="form-check">
                                            <div class="container">
                                                <input class="form-check-input" type="radio" name="type" id="A" value="A" {{(old('type') == 'A') ? 'checked' : ''}}>
                                                <label class="form-check-label" for="A"> Administrador </label>
                                            </div>
                                        </div>
                                        <div class="form-check">
                                            <div class="container">
                                                <input class="form-check-input" type="radio" name="type" id="E" value="E" {{(old('type') == 'E') ? 'checked' : ''}}>
                                                <label class="form-check-label" for="E"> Empleado </label>
                                            </div>
                                        </div>
                                        <span class="" role="alert">
                                            <strong style="font-size: 82%; color: #d9534f"> {{ $errors->first('type', ':message') }} </strong>
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Contraseña</label>
                                        <input 
                                            type="password" 
                                            name="password" 
                                            class="form-control bg-ligth shadow-sm @if($errors->first('password')) is-invalid @endif" 
                                            id="password" 
                                            placeholder="Ingrese contraseña"
                                            value="{{ (old('password')) }}"
                                            autocomplete="new-password">
                                            <span class="invalid-feedback" role="alert">
                                                <strong> {{ $errors->first('password', ':message') }} </strong>
                                            </span>
                                    </div>
                                    <div class="form-group">
                                        <label for="password-confirm">Confirmar contraseña</label>
                                        <input 
                                            type="password" 
                                            name="password_confirmation" 
                                            class="form-control bg-ligth shadow-sm @if($errors->first('password_confirmation')) is-invalid @endif" 
                                            id="password-confirm" 
                                            placeholder="Ingrese contraseña"
                                            value="{{ (old('password_confirmation')) }}"
                                            autocomplete="new-password">
                                            <span class="invalid-feedback" role="alert">
                                                <strong> {{ $errors->first('password_confirmation', ':message') }} </strong>
                                            </span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center mt-2">
                                        <!-- <a href="{{ URL::previous() }}" class="btn btn-secondary">Cancelar</a> -->
                                        <a href="{{route('users.index')}}" class="btn btn-secondary">Cancelar</a>
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
@push('scripts')
    <script src="{{asset('js/app.js')}}"></script>
    <!-- <script src="{{asset('js/add_product.js')}}"></script> -->
@endpush