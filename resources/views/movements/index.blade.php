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
                                    <h4>Movimientos</h4>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="{{ route('movements.create') }}"><button title="Agregar movimiento" class="btn btn-success"><i class="fa fa-plus"></i> Agregar</button></a>
                                </div>
                            </div>
                        </div>
                    <!-- </a> -->
                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
                            <form action="{{ route('movements.index') }}" method="GET" autocomplete="off">   
                                <div class="row mb-4">
                                    <div class="col-md-4 col-sm-6 mb-2">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">DESDE</div>
                                            </div>
                                            <input id="from" type ="date" name="from" value="{{isset($from) ? $from : $today}}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-sm-6 mb-2">
                                        <div class="input-group">	
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">HASTA</div>
                                            </div>
                                            <input id="to" type ="date" name="to" value="{{isset($to) ? $to : $today}}" class="form-control">	
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <button class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                    </div>
                                </div>
                            </form>

                            <div class="row">
                                <div class="col-md-12">
                                    <table id="example1" class="table table-bordered table-sm data-table-movements">
                                        <thead class="text-center">
                                        <tr>
                                            <th>Concepto</th>
                                            <th>Fecha</th>
                                            <th>Hora</th>
                                            <th>Tipo</th>
                                            <th>Forma de pago</th>
                                            <th>Monto</th>
                                        </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            @foreach ($movements as $mov)
                                                <tr>
                                                    <td width="35%">{{ $mov->concept }}</td>
                                                    <td>{{ $mov->created_at->format('d-m-Y') }}</td>
                                                    <td width="12%">{{ $mov->created_at->format('H:i') }}</td>
                                                    <td>{{ $mov->type }}</td>
                                                    <td width="18%">{{ $mov->method_of_payment->name }}</td>
                                                    <td>{{ $mov->amount }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr class="total-footer">
                                                <!-- <th colspan="3" class="text-center"></th> -->
                                                <th class="text-center alert-success"><b>INGRESOS</b></th>
                                                <th class="text-center alert-success"></th>
                                                <th class="text-center alert-danger"><b>EGRESOS</b></th>
                                                <th class="text-center alert-danger"></th>
                                                <th class="text-center alert-secondary">TOTAL</th>
                                                <th class="text-center alert-secondary"></th>
                                            </tr>
                                        </tfoot>
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
    <script src="{{asset('js/data_table_movements.js')}}"></script>
@endpush  