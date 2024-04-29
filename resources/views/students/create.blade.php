@extends('layouts.admin')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-8 col-md-12 offset-md-2" id="accordion">
                <div class="card card-success card-outline">
                    <!-- <a class="d-block w-100" data-toggle="collapse" href="#collapseOne"> -->
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12 card-title text-center">
                                <h4>Nuevo Alumno</h4>
                            </div>
                        </div>
                    </div>
                    <!-- </a> -->
                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
                            <form  action="{{ route('students.store') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="">
                                        <h3 class="card-title mb-3"><b>Datos personales</b></h3>
                                        <small class="form-text text-muted"> (*) Campo obligatorio</small>
                                    </div>
                                   
                                    <div class="form-row w-100">
                                        <div class="col-md-6 mb-3">
                                            <label for="name">Nombre(*)</label>
                                            <input class="form-control mb-3 bg-ligth shadow-sm @if($errors->first('name')) is-invalid @endif"
                                            id="name"
                                            type="text"
                                            name="name"
                                            value="{{old('name')}}">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong> {{ $errors->first('name', ':message') }} </strong>
                                                </span>
                                            <label for="lastname">Apellido(*)</label>
                                            <input class="form-control mb-3 bg-ligth shadow-sm @if($errors->first('lastname')) is-invalid @endif"
                                            id="lastname"
                                            type="text"
                                            name="lastname"
                                            value="{{old('lastname')}}">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong> {{ $errors->first('lastname', ':message') }} </strong>
                                                </span>
                                        </div>
                                        <div class="col-md-6" mb-3>
											<label>Foto del alumno</label>
											<div class="row">
												<div class="col-lg-4">
													<!-- Video via webcam -->
													<!-- <div class="video-wrap"> -->
														<video id="video" playsinline autoplay style="border:1px solid #b0b8b9; height:100px"></video>
												<!-- 	</div> -->
													<!-- Boton para tomar foto -->
													<div class="controller" > 
														<input type="button" name="snap" id="snap" value="Capturar foto" class="btn btn-outline-info btn-sm"> 
													</div>
												</div>
												<div class="col-lg-2">
														<canvas id="canvas" width="110" height="100" style="border:1px solid #b0b8b9;"></canvas>
														<input style="display:none" id='photo_camera' name="photo_camera" type="text" class="form-control">
												</div>
											</div> <!-- end row -->		
										</div> <!-- end col-lg-6-->
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-4 mb-3">
                                            <label for="dni">DNI</label>
                                            <input class="form-control bg-ligth shadow-sm @if($errors->first('dni')) is-invalid @endif"
                                            id='input_dni'
                                            type="number"
                                            name="dni"
                                            value="{{old('dni')}}"
                                            >
                                                <span class="invalid-feedback" role="alert">
                                                    <strong> {{ $errors->first('dni', ':message') }} </strong>
                                                </span>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="birthdate">Fecha de nacimiento (*)</label>                   
                                                <input class="form-control bg-ligth shadow-sm @if($errors->first('birthdate')) is-invalid @endif"
                                                id='input_birthdate'
                                                type ="date" 
                                                name="birthdate" 
                                                value="{{old('birthdate')}}">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong> {{ $errors->first('birthdate', ':message') }} </strong>
                                                </span>
                                        </div>
                                       
                                        <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1">Sexo (*)</label>
                                            <div class="form-check">
                                                <div class="container">
                                                    <input class="form-check-input" type="radio" name="gender" id="F" value="F" {{(old('gender') == 'F') ? 'checked' : ''}}>
                                                    <label class="form-check-label" for="F"> Femenino </label>
                                                </div>
                                                
                                            </div>
                                            <div class="form-check">
                                                <div class="container">
                                                    <input class="form-check-input" type="radio" name="gender" id="M" value="M" {{(old('gender') == 'M') ? 'checked' : ''}}>
                                                    <label class="form-check-label" for="M"> Masculino </label>
                                                </div>
                                            </div>
                                            <span class="" role="alert">
                                                <strong style="font-size: 82%; color: #d9534f"> {{ $errors->first('gender', ':message') }} </strong>
                                            </span>
                                        </div>
                                    </div>    
                                    <div class="form-group">
                                        <label for="address">Domicilio (*)</label>
                                        <input class="form-control bg-ligth shadow-sm @if($errors->first('address')) is-invalid @endif"
                                        id="address"
                                        type="text"
                                        name="address"
                                        value="{{old('address')}}">
                                            <span class="invalid-feedback" role="alert">
                                                <strong> {{ $errors->first('address', ':message') }} </strong>
                                            </span>
                                    </div>
                                
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label for="phone_number">Teléfono (*)</label>
                                            <input class="form-control bg-ligth shadow-sm @if($errors->first('phone_number')) is-invalid @endif"
                                            id="phone_number"
                                            type="text"
                                            name="phone_number"
                                            value="{{old('phone_number')}}">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong> {{ $errors->first('phone_number', ':message') }} </strong>
                                                </span>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="contact_number">Contacto</label>
                                            <input class="form-control bg-ligth shadow-sm @if($errors->first('contact_number')) is-invalid @endif"
                                            id="contact_number"
                                            type="text"
                                            name="contact_number"
                                            value="{{old('contact_number')}}">
                                        </div>
                                    </div>                     
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" 
                                        class="form-control" 
                                        id="email" 
                                        name="email"
                                        placeholder="nombre@ejemplo.com"
                                        value="{{old('email')}}">
                                    </div>
                                    
                                    <div class="form-row">
                                        <h3 class="card-title mb-3"><b>Otros datos</b></h3>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">¿Presentó certificado?</label>
                                                <div class="form-check">
                                                    <div class="container">
                                                        <input class="form-check-input" type="radio" name="certificate" id="SI" value=1 {{(old('certificate') == 1) ? 'checked' : ''}}>
                                                        <label class="form-check-label" for="SI"> Si </label>
                                                    </div>
                                                    
                                                </div>
                                                <div class="form-check">
                                                    <div class="container">
                                                        <input class="form-check-input" type="radio" name="certificate" id="NO" value=0 {{(old('certificate') == 0) ? 'checked' : ''}} checked>
                                                        <label class="form-check-label" for="NO"> No </label>
                                                    </div>
                                                </div>
                                                <span class="" role="alert">
                                                    <strong style="font-size: 82%; color: #d9534f"> {{ $errors->first('certificate', ':message') }} </strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="certificate_date">Fecha de presentación</label>                   
                                                <input class="form-control bg-ligth shadow-sm @if($errors->first('certificate_date')) is-invalid @endif"
                                                id='input_certificate_date'
                                                type ="date" 
                                                name="certificate_date" 
                                                value="{{ old('certificate_date') }}">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong> {{ $errors->first('certificate_date', ':message') }} </strong>
                                                </span>
                                        </div>
                                    </div>    
                                    <div class="form-group">
                                        <label for="observations">Observaciones</label>
                                        <textarea class="form-control" id="observations" name="observations" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="routine">Rutina</label>
                                        <textarea class="form-control" id="routine" name="routine" rows="3"></textarea>
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
@push('scripts')
    <script src="{{asset('js/add_photo_student.js')}}"></script>
@endpush
