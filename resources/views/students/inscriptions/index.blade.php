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
                                        <table class="table table-bordered table-sm data-table-inscriptions" data-id="{{ $student->id }}">
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
                                                @foreach ($student->inscriptions as $ins)
                                                    <tr"> 
                                                        <td>{{ $ins->activity->name }}</td>
                                                        <td>{{ $ins->plan->name }}</td>
                                                        <td>{{ $ins->expiration_date->format('d-m-Y') }}</td>
                                                        <td>{{ $ins->classes }}</td>
                                                        <td class="@if ($ins->balance > 0) text-danger @endif">${{ number_format($ins->balance, 2, ',', '.') }}</td>
                                                        <td>{{ ucfirst($ins->state) }}</td>
                                                        <td>
                                                            <a href="{{ route('inscriptions.show',$ins->id) }}"><button title="Actualizar saldo" type="submit" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i> Saldo</button></a>
                                                            @if(Auth::user()->type =='A')
                                                                <a href="{{ route('inscriptions.editExpiration',$ins->id) }}"><button title="Actualizar vencimiento" type="submit" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i> Vencimiento</button></a>
                                                                <a href="" id="delete-{{$ins->id}}" name="delete-{{$ins->id}}" data-target="#modal-delete-{{$ins->id}}" data-toggle="modal"><button class="btn btn-danger btn-sm" name="Eliminar-{{$ins->id}}"><i class="fa fa-trash-alt"></i> Eliminar</button></a>
                                                                @include('students.inscriptions.destroy')
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
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