@extends('layouts.admin')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-6 offset-md-3" id="accordion">
                <div class="card card-success card-outline">
                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
                            <div class="text-center">
                                <img src="/img/students/{{ $student->photo }}" width="80px" height="80px" class="rounded-circle" alt="photo-student">
                            </div>
                            <div class="text-center mt-2">
                                <h5>{{ $student->name }} {{ $student->lastname}}</h5>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="h6"><strong>DNI: </strong>{{ $student->dni }}</p>
                                    <p class="h6"><strong>Fecha de nacimiento: </strong>{{ \Carbon\Carbon::parse($student->birthdate)->format('d-m-Y') }}</p>
                                    <p class="h6"><strong>Sexo: </strong>{{ $student->gender == 'F' ? 'Femenino' : 'Masculino' }}</p>
                                    <p class="h6"><strong>Domicilio: </strong>{{ $student->address }}</p>
                                    <p class="h6"><strong>Teléfono: </strong>{{ $student->phone_number }}</p>
                                    <p class="h6"><strong>Contacto: </strong>{{ $student->contact_number ? $student->contact_number : '-' }}</p>
                                    <p class="h6"><strong>Email: </strong>{{ $student->email ? $student->email : '-' }}</p>
                                    <p class="h6"><strong>Fecha de presentación de certificado: </strong>{{ $student->certificate_date ? \Carbon\Carbon::parse($student->certificate_date)->format('d-m-Y') : 'No presentado' }}</p>
                                    <p class="h6"><strong>Observaciones: </strong>{{ $student->observations ? $student->observations : 'Sin observaciones' }}</p>
                                    <p class="h6"><strong>Rutina: </strong>{{ $student->routine ? $student->routine : 'Sin rutina' }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center mt-2">
                                    <a href="{{ URL::previous() }}" class="btn btn-secondary" autofocus>Volver</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection