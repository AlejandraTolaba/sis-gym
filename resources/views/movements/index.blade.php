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
                            <!-- <form action="{{ route('movementsFromTo') }}" method="GET" autocomplete="off">
                                @csrf    
                                <div class="row mb-4">
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">DESDE</div>
                                            </div>
                                            <input type ="date" name="from" value="{{isset($from) ? $from : $today}}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="input-group">	
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">HASTA</div>
                                            </div>
                                            <input type ="date" name="to" value="{{isset($to) ? $to : $today}}" class="form-control">	
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-1">
                                        <button class="btn btn-primary" name="filtrar"><i class="fa fa-calendar"></i></button>
                                    </div>
                                </div>
                            </form> -->

                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">TOTAL INGRESOS</div>
                                        </div>	
                                        <input readonly type ="text" name="total_incomes" value="${{$total_incomes}}" class="form-control bg-white">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">	
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">TOTAL EGRESOS</div>
                                        </div>	
                                        <input readonly type ="text" name="totalExpenses" value="${{$total_expenses}}" class="form-control bg-white">	
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">	
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">TOTAL</div>
                                        </div>	
                                        <input readonly type ="text" name="total" value="${{$total}}" class="form-control bg-white">	
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered table-sm data-table" width="100%">
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
                                                    <td>{{ $mov->concept }}</td>
                                                    <td>{{ $mov->created_at->format('d-m-Y') }}</td>
                                                    <td>{{ $mov->created_at->format('H:i') }}</td>
                                                    <td>{{ $mov->type }}</td>
                                                    <td>{{ $mov->method_of_payment->name }}</td>
                                                    <td>$<?=number_format($mov->amount,2,',','.') ?></td>
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
    @push('scripts')
    
    @endpush    
@endsection