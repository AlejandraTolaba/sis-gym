@extends('layouts.admin')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show col-md-12" role="alert">
            <strong>{{session('success')}}</strong>
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
                                    <div class="col-md-12 table-responsive-md">
                                        <table class="table table-bordered table-sm data-table">
                                            <thead class="text-center">
                                            <tr>
                                                <th>Actividad</th>
                                                <th>Plan</th>
                                                <th width="100px">Fecha de vencimiento</th>
                                                <th width="100px">Cantidad de clases</th>
                                                <th>Saldo</th>
                                                <th width="100px">Estado</th>
                                                <th>Opciones</th>
                                            </tr>
                                            </thead>
                                            <tbody class="text-center">
                                                @foreach ($student->inscriptions as $insc)
                                                    <tr>
                                                        <td>{{ $insc->activity->name }}</td>
                                                        <td>{{ $insc->plan->name }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($insc->expiration_date)->format('d-m-Y') }}</td> 
                                                        <td>{{ $insc->classes }}</td>
                                                        @if( $insc->balance > 0)
                                                            <td class = "text-danger">$<?=number_format($insc->balance,2,',','.') ?></td>
                                                        @else 
                                                            <td>$<?=number_format($insc->balance,2,',','.') ?></td>
                                                        @endif 
                                                        <td>{{ ucfirst($insc->state) }}</td>
                                                        <td><a href="{{ route('inscriptions.updateBalance',$insc->id) }}"><button name="updateBalance" title="Actualizar saldo" type="submit" class="btn btn-warning"><i class="fas fa-pencil-alt"></i> Actualizar saldo</button></a></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="text-center text-lg alert alert-secondary alert-important">
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