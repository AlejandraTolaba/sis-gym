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
                                <img src="/img/teachers/{{ $teacher->photo }}" width="80px" height="80px" class="rounded-circle" alt="photo-teacher">
                            </div>
                            <div class="text-center mt-2">
                                <h5>{{ $teacher->name }} {{ $teacher->lastname}}</h5>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="h6"><strong>DNI: </strong>{{ $teacher->dni }}</p>
                                    <p class="h6"><strong>Fecha de nacimiento: </strong>{{ $teacher->birthdate->format('d-m-Y') }}</p>
                                    <p class="h6"><strong>Sexo: </strong>{{ $teacher->gender == 'F' ? 'Femenino' : 'Masculino' }}</p>
                                    <p class="h6"><strong>Domicilio: </strong>{{ $teacher->address }}</p>
                                    <p class="h6"><strong>Teléfono: </strong>{{ $teacher->phone_number }}</p>
                                    <p class="h6"><strong>Contacto: </strong>{{ $teacher->contact_number ? $teacher->contact_number : '-' }}</p>
                                    <p class="h6"><strong>Email: </strong>{{ $teacher->email ? $teacher->email : '-' }}</p>
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