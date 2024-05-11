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
                                <h4>Editar datos de {{ $teacher->name }} {{ $teacher->lastname}}</h4>
                                <div class="text-center">
                                    <img src="{{asset('img/teachers/'.$teacher->photo)}}" width="90px" height="90px" class="rounded-circle" alt="photo-teacher">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- </a> -->
                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
                            <form  action="{{ route('teachers.update',$teacher->id) }}" method="POST">
                                {{ csrf_field() }}
                                @method('PUT')
                                <div class="card-body">
                                    <div class="">
                                        <h3 class="card-title mb-3"><b>Datos personales</b></h3>
                                        <small class="form-text text-muted"> (*) Campo obligatorio</small>
                                    </div>
                                   
                                    <div class="form-row w-100">
                                        <div class="col-md-6 mb-3">
                                            <label for="name">Nombre(*)</label>
                                            <input class="form-control bg-ligth shadow-sm @if($errors->first('name')) is-invalid @endif"
                                            id="name"
                                            type="text"
                                            name="name"
                                            value="{{old('name',$teacher->name)}}">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong> {{ $errors->first('name', ':message') }} </strong>
                                                </span>
                                            <label for="lastname" class="mt-3">Apellido(*)</label>
                                            <input class="form-control bg-ligth shadow-sm @if($errors->first('lastname')) is-invalid @endif"
                                            id="lastname"
                                            type="text"
                                            name="lastname"
                                            value="{{old('lastname',$teacher->lastname)}}">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong> {{ $errors->first('lastname', ':message') }} </strong>
                                                </span>
                                        </div>
                                        <div class="col-md-6" mb-3>
											<label>Foto</label>
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
                                            value="{{old('dni', $teacher->dni)}}"
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
                                                value="{{old('birthdate', $teacher->birthdate->toDateString())}}">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong> {{ $errors->first('birthdate', ':message') }} </strong>
                                                </span>
                                        </div>
                                       
                                        <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1">Sexo (*)</label>
                                            <div class="form-check">
                                                <div class="container">
                                                    <input class="form-check-input" type="radio" name="gender" id="F" value="F" {{(old('gender',$teacher->gender) == 'F') ? 'checked' : ''}}>
                                                    <label class="form-check-label" for="F"> Femenino </label>
                                                </div>
                                                
                                            </div>
                                            <div class="form-check">
                                                <div class="container">
                                                    <input class="form-check-input" type="radio" name="gender" id="M" value="M" {{(old('gender',$teacher->gender) == 'M') ? 'checked' : ''}}>
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
                                        value="{{old('address',$teacher->address)}}">
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
                                            value="{{old('phone_number',$teacher->phone_number)}}">
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
                                            value="{{old('contact_number',$teacher->contact_number)}}">
                                        </div>
                                    </div>                     
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" 
                                        class="form-control" 
                                        id="email" 
                                        name="email"
                                        placeholder="nombre@ejemplo.com"
                                        value="{{old('email',$teacher->email)}}">
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-12 text-center mt-3">
                                            <a href="{{ route('teachers.index') }}" class="btn btn-secondary">Cancelar</a>
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
    <script src="{{asset('js/add_photo_teacher.js')}}"></script>
@endpush
