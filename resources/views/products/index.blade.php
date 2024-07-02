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
                                <div class="card-title col-md-6 text-left">
                                    <h4>Productos</h4>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="{{ route('products.create') }}"><button title="Agregar producto" class="btn btn-success"><i class="fa fa-plus"></i> Agregar</button></a>
                                </div>
                            </div>
                        </div>
                    <!-- </a> -->
                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered data-table-products table-sm" width="100%">
                                    <thead class="text-center">
                                    <tr>
                                        <th>Código</th>
                                        <th>Nombre</th>
                                        <th>Stock</th>
                                        <th>Precio</th>
                                        <th>Opciones</th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @foreach ($products as $prod)
                                            <tr> 
                                                <td>{{ $prod->code }}</td>
                                                <td>{{ $prod->name }}</td>
                                                <td class="@if ($prod->stock < 10 && $prod->stock != 0) text-info @elseif ($prod->stock == 0) text-danger @endif">{{ $prod->stock }}</td>
                                                <td>${{ number_format($prod->price, 2, ',', '.') }}</td>
                                                <td>
                                                    <a href="{{ route('products.edit',$prod->id) }}"><button name="Editar" title="Editar producto" type="submit" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i> Editar</button></a>
                                                    <a href="" id="delete-{{$prod->id}}" name="delete-{{$prod->id}}" data-target="#modal-delete-{{$prod->id}}" data-toggle="modal"><button class="btn btn-danger btn-sm" name="Eliminar-{{$prod->id}}"><i class="fa fa-trash-alt"></i> Eliminar</button></a>
                                                    @include('products.destroy')
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