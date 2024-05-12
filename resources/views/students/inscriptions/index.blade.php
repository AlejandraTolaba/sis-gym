@extends('layouts.admin')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show col-md-12" role="alert">
            <strong>{{session('success')}}</strong>
        </div>         
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show col-md-12" role="alert">
            <strong>{{session('error')}}</strong>
        </div>         
    @endif
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12" id="accordion">
                <div class="card card-success card-outline">
                    <!-- <a class="d-block w-100" data-toggle="collapse" href="#collapseOne"> -->
                        <div class="card-header">
                            <div class="row">
                                <div class="card-title col-md-6 text-left">
                                    <h4>Inscripciones de {{$student->name}} {{$student->lastname}}</h4>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="{{ route('inscriptions.create', $student->id) }}"><button class="btn btn-success" title="Agregar inscripción"><i class="fa fa-plus"></i> Agregar</button></a>
                                </div>
                            </div>
                        </div>
                    <!-- </a> -->
                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
                            <!-- <div class="row"> -->
                                @if ($student->inscriptions->isNotEmpty())
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-sm data-table-act-inscriptions" data-id="{{ $student->id }}">
                                            <thead class="text-center">
                                            <tr>
                                                <th>Actividad</th>
                                                <th>Plan</th>
                                                <th>Fecha de vencimiento</th>
                                                <th>Cantidad de clases</th>
                                                <th>Saldo</th>
                                                <th>Estado</th>
                                                <th>Opciones</th>
                                            </tr>
                                            </thead>
                                            <tbody class="text-center">
                                               
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="text-center alert alert-secondary alert-important">
                                        Sin inscripciones
                                    </div>
                                @endif
                            <!-- </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
@push('scripts')
    <script src="{{asset('js/data_table.js')}}"></script>
@endpush  