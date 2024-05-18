@extends('layouts.admin')

@section('content')
    @if (session()->has('info'))
        <div class="alert alert-success alert-dismissible alert-important fade show col-md-6 offset-md-3" role="alert">
            <strong>{{session('info')}}</strong>
        </div>         
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible alert-important fade show col-md-6 offset-md-3" role="alert">
            <strong>{{session('error')}}</strong>
        </div>         
    @endif
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-6 offset-md-3" id="accordion">
                <div class="card card-success card-outline">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h4>Modificar Contraseña</h4>
                            </div>
                        </div>
                    </div>
                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
                            <form  action="{{ route('users.update',$user->id) }}" method="POST">
                                {{ csrf_field() }}
                                @method('PATCH')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="password">Contraseña</label>
                                        <input 
                                            type="password" 
                                            name="password" 
                                            class="form-control bg-ligth shadow-sm @if($errors->first('password')) is-invalid @endif" 
                                            id="password" 
                                            placeholder="Ingrese contraseña"
                                            value=""
                                            autocomplete="new-password">
                                            <span class="invalid-feedback" role="alert">
                                                <strong> {{ $errors->first('password', ':message') }} </strong>
                                            </span>
                                    </div>
                                    <div class="form-group">
                                        <label for="new-password">Nueva Contraseña</label>
                                        <input 
                                            type="password" 
                                            name="new_password" 
                                            class="form-control bg-ligth shadow-sm @if($errors->first('new_password')) is-invalid @endif" 
                                            id="new_password" 
                                            placeholder="Ingrese nueva contraseña"
                                            value=""
                                            autocomplete="new-password">
                                            <span class="invalid-feedback" role="alert">
                                                <strong> {{ $errors->first('new_password', ':message') }} </strong>
                                            </span>
                                    </div>
                                    <div class="form-group">
                                        <label for="password-confirm">Confirmar contraseña</label>
                                        <input 
                                            type="password" 
                                            name="new_password_confirmation" 
                                            class="form-control bg-ligth shadow-sm @if($errors->first('new_password_confirmation')) is-invalid @endif" 
                                            id="password-confirm" 
                                            placeholder="Ingrese contraseña"
                                            value=""
                                            autocomplete="new-password">
                                            <span class="invalid-feedback" role="alert">
                                                <strong> {{ $errors->first('new_password_confirmation', ':message') }} </strong>
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