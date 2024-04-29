@extends('layouts.admin')

@section('content')
    @if (session()->has('info'))
        <div class="alert alert-success alert-dismissible fade show col-md-8 offset-md-2" role="alert">
            <strong>{{session('info')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>         
    @endif
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-8 col-md-12 offset-md-2" id="accordion">
                <div class="card card-success card-outline">
                    <!-- <a class="d-block w-100" data-toggle="collapse" href="#collapseOne"> -->
                        <div class="card-header">
                            <div class="row">
                                <div class="card-title col-md-6 text-left">
                                    <h4>Inscripciones de {{$student->name}} {{$student->lastname}}</h4>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="{{ route('inscriptions.create', $student->id) }}"><button class="btn btn-success"><i class="fa fa-plus"></i> Agregar</button></a>
                                </div>
                            </div>
                        </div>
                    <!-- </a> -->
                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
                            <div class="row">
                                @if ($student->inscriptions->isNotEmpty())
                                    <div class="col-md-12">
                                        <table class="table table-bordered" width="100%">
                                            <thead class="text-center">
                                            <tr>
                                                <th>Actividad</th>
                                                <th>Plan</th>
                                                <th>Fecha de vencimiento</th>
                                                <th>Cantidad de clases</th>
                                                <th>Saldo</th>
                                                <th>Estado</th>
                                            </tr>
                                            </thead>
                                            <tbody class="text-center">
                                                @foreach ($student->inscriptions as $insc)
                                                    <tr>
                                                        <td>{{ $insc->activity->name }}</td>
                                                        <td>{{ $insc->plan->name }}</td>
                                                        <td><?php $fv = new DateTime($insc->expiration_date); echo $fv->format('d-m-Y');?></td> 
                                                        <td>{{ $insc->classes }}</td>
                                                        @if($insc->balance > 0)
                                                        <td class = "danger text-danger">{{'$'.$insc->balance}}</td>
                                                        @else 
                                                            <td>{{ '$'.$insc->balance }}</td>
                                                        @endif 
                                                        <td>{{ $insc->state }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="text-center col-md-12 text-lg">
                                        <p>Sin inscripciones</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection