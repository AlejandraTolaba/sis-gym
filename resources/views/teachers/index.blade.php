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
                                    <h4>Profesores</h4>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="{{ route('teachers.create') }}"><button title="Agregar profesor" class="btn btn-success"><i class="fa fa-plus"></i> Agregar</button></a>
                                </div>
                            </div>
                        </div>
                    <!-- </a> -->
                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered data-table-teachers" width="100%">
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
    @push('scripts')
    <script>
        $(function(){
            var table = $('.data-table-teachers').DataTable({
                ajax: "{{ route('teachers.index')}}",
                columns: [
                    { data: 'fullname', name:'fullname'},
                    { data: 'photo', name:'photo', orderable:false, searchable:false},
                    { data: 'dni', name:'dni', orderable:false},
                    { data: 'phone_number', name:'phone_number', orderable:false, searchable:false},
                    { data: 'state', name:'state', orderable:false},
                    { data: 'action', name:'action', orderable:false, searchable:false},
                ],
                language: {
                    "decimal": ",",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ".",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
                responsive: true,
            });
        });
    </script>
    @endpush    
@endsection