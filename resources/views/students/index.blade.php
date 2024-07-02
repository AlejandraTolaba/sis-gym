@extends('layouts.admin')

@section('content')
    @if (session()->has('info'))
        <div class="alert alert-success alert-dismissible fade show col-md-12" role="alert">
            <strong>{{session('info')}}</strong>
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
                                    <h4>Alumnos</h4>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="{{ route('students.create') }}"><button title="Agregar alumno" class="btn btn-success"><i class="fa fa-user-plus"></i> Agregar</button></a>
                                </div>
                            </div>
                        </div>
                    <!-- </a> -->
                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered data-table-students table-sm" width="100%">
                                    <thead class="text-center">
                                    <tr>
                                        <th>Nombre y Apellido</th>
                                        <th>Foto</th>
                                        <th>DNI</th>
                                        <th>Teléfono</th>
                                        <th>Estado</th>
                                        <th>Saldo</th>
                                        <th>Opciones</th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    @foreach ($students as $stu)
                                            <tr> 
                                                <td>{{ $stu->name }} {{ $stu->lastname }}</td>
                                                <td><img src="{{asset('img/students/'.$stu->photo)}}" width="50px" height="50px"></td>
                                                <td>{{ $stu->dni }}</td>
                                                <td>{{ $stu->phone_number }}</td>
                                                <td>{{ ucfirst($stu->state) }}</td>
                                                <td class="@if ($stu->balance > 0) text-danger @endif">${{ number_format($stu->balance, 2, ',', '.') }}</td>
                                                <td>
                                                    <a href="{{ route('students.show',$stu->id) }}"><button name="show-dates" title="Ver datos de alumno" type="submit" class="btn btn-success btn-sm"><i class="fa fa-user"></i> Visualizar</button></a>
                                                    <a href="{{ route('students.edit',$stu->id) }}"><button name="edit" title="Editar alumno" type="submit" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i> Editar</button></a>
                                                    <a href="{{route('inscriptions',$stu->id)}}"><button name="index" type="submit" title="Ver inscripciones" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Inscripciones</button></a>
                                                    <a href="{{ route('bodychecks',$stu->id) }}"><button name="show" title="Ver fichas de control corporal" type="submit" class="btn btn-primary btn-sm"><i class="fa fa-file"></i> Fichas de control</button></a>
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