@extends('layouts.admin')

@section('content')
    @if (session()->has('info'))
        <div class="alert alert-success alert-dismissible fade show col-md-8 offset-md-2" role="alert">
            <strong>{{session('info')}}</strong>
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
                                    <table class="table table-bordered data-table" width="100%">
                                    <thead class="text-center">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
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
            var table = $('.data-table').DataTable({
                ajax: "{{ route('activities.index')}}",
                columns: [
                    { data: 'id', name:'id'},
                    { data: 'name', name:'name'},
                    { data: 'state', name:'state'},
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