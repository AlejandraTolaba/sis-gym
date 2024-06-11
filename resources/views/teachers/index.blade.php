@extends('layouts.admin')

@section('content')
    @if (session()->has('info'))
        <div class="alert alert-success alert-dismissible fade show col-md-12" role="alert">
            <strong>{{session('info')}}</strong>
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
                                    <h4>Profesores</h4>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="{{ route('teachers.create') }}"><button title="Agregar profesor" class="btn btn-success"><i class="fa fa-user-plus"></i> Agregar</button></a>
                                </div>
                            </div>
                        </div>
                    <!-- </a> -->
                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered data-table-teachers table-sm" width="100%">
                                    <thead class="text-center">
                                    <tr>
                                        <th>Nombre y Apellido</th>
                                        <th>Foto</th>
                                        <th>DNI</th>
                                        <th>Teléfono</th>
                                        <th>Estado</th>
                                        <th>Opciones</th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @foreach ($teachers as $teacher)
                                            <tr class="@if ($teacher->state == 'inactivo') danger text-danger @endif"> 
                                                <td>{{ $teacher->name }} {{ $teacher->lastname }}</td>
                                                <td><img src="{{asset('img/teachers/'.$teacher->photo)}}" width="50px" height="50px"></td>
                                                <td>{{ $teacher->dni }}</td>
                                                <td>{{ $teacher->phone_number }}</td>
                                                <td>{{ ucfirst($teacher->state) }}</td>
                                                <td>
                                                    <a href="{{ route('teachers.show',$teacher->id) }}"><button {{ $teacher->state !='activo' ? 'disabled' : '' }} name="show-dates" title="Ver datos de profesor" type="submit" class="btn btn-success btn-sm"><i class="fa fa-user"></i> Visualizar</button></a>
                                                    <a href="{{ route('teachers.edit',$teacher->id) }}"><button {{ $teacher->state !='activo' ? 'disabled' : '' }} name="edit" title="Editar profesor" type="submit" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i> Editar</button></a>
                                                    @if(Auth::user()->type =='A')
                                                        <a href="" id="Eliminar-{{$teacher->id}}" data-target="#modal-delete-{{$teacher->id}}" data-toggle="modal"><button class="{{ $teacher->state !='activo' ? "btn btn-success btn-sm" : "btn btn-danger btn-sm" }}" title="{{ $teacher->state !='activo' ? 'Activar profesor' : 'Desactivar profesor' }}"><i class="{{ $teacher->state !='activo' ? 'fa fa-check' : 'fa fa-times' }}"></i> {{ $teacher->state !='activo' ? 'Activar' : 'Desactivar' }}</button></a>
                                                        @include('teachers.destroy')
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