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
                                    <h4>Usuarios</h4>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="{{ route('users.create') }}"><button title="Agregar usuario" class="btn btn-success"><i class="fa fa-user-plus"></i> Agregar</button></a>
                                </div>
                            </div>
                        </div>
                    <!-- </a> -->
                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered data-table-users table-sm" width="100%">
                                    <thead class="text-center">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>E-mail</th>
                                        <th>Tipo</th>
                                        <th>Opciones</th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @foreach ($users as $user)
                                            <tr> 
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->type == 'A' ? 'Administrador' : 'Empleado' }}</td>
                                                <td>
                                                    <a href="" id="Eliminar-{{$user->id}}" data-target="#modal-delete-{{$user->id}}" data-toggle="modal"><button class="btn btn-danger btn-sm" name="Eliminar-{{$user->id}}" title="Eliminar usuario"><i class="fa fa-trash-alt"></i> Eliminar</button></a>
                                                    @include('users.destroy')
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