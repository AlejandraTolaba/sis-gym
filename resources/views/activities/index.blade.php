@extends('layouts.admin')

@section('content')
    @if (session()->has('info'))
        <div class="alert alert-success alert-dismissible fade show col-md-8 offset-md-2" role="alert">
            <strong>{{session('info')}}</strong>
        </div>         
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show col-md-8 offset-md-2" role="alert">
            <strong>{{session('error')}}</strong>
        </div>         
    @endif
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-8 offset-md-2" id="accordion">
                <div class="card card-success card-outline">
                    <!-- <a class="d-block w-100" data-toggle="collapse" href="#collapseOne"> -->
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6 text-left">
                                    <h4>Actividades</h4>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="{{ route('activities.create') }}"><button title="Agregar actividad" class="btn btn-success"><i class="fa fa-plus"></i> Agregar</button></a>
                                </div>
                            </div>
                        </div>
                    <!-- </a> -->
                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered data-table-activities table-sm" width="100%">
                                    <thead class="text-center">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Estado</th>
                                        <th>Opciones</th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @foreach ($activities as $act)
                                            <tr> 
                                                <td>{{ $act->id }}</td>
                                                <td>{{ $act->name }}</td>
                                                <td>{{ ucfirst($act->state) }}</td>
                                                <td>
                                                @if ($act->state !='inactiva')
                                                    <a href="{{ route('activities.edit',$act->id) }}"><button name="Editar" title="Editar planes" type="submit" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i> Editar</button></a>
                                                    <a href="{{route('showInscriptions',$act->id)}}"><button name="show" type="submit" title="Ver inscripciones" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Inscripciones</button></a>
                                                    @if(Auth::user()->type =='A')
                                                        <a href="#" id="delete-{{$act->id}}" name="delete-{{$act->id}}" data-target="#modal-delete-{{$act->id}}" data-toggle="modal"><button class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Desactivar</button></a>
                                                        @include('activities.destroy')
                                                    @endif
                                                    @else
                                                        <a href="{{ route('activities.edit',$act->id) }}"><button disabled name="Editar" title="Editar planes" type="submit" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i> Editar</button></a>
                                                        <a href="{{route('showInscriptions',$act->id)}}"><button disabled name="show" type="submit" title="Ver inscripciones" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Inscripciones</button></a>
                                                        @if(Auth::user()->type =='A')
                                                            <a href="#" id="delete-{{$act->id}}" name="delete-{{$act->id}}" data-target="#modal-delete-{{$act->id}}" data-toggle="modal"><button class="btn btn-success btn-sm"><i class="fa fa-check"></i> Activar</button></a>
                                                            @include('activities.destroy')
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    </table>
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
@push('scripts')
    <script src="{{asset('js/data_table.js')}}"></script>
@endpush   