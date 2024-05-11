@extends('layouts.admin')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-8 offset-md-2" id="accordion">
                <div class="card card-success card-outline">
                    <!-- <a class="d-block w-100" data-toggle="collapse" href="#collapseOne"> -->
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h4>Inscripciones de {{ $activity->name }}</h4>
                                </div>
                            </div>
                        </div>
                    <!-- </a> -->
                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
                            <form action="{{ route('showInscriptions', $activity->id) }}" method="GET" autocomplete="off">   
                                <div class="row mb-4">
                                    <div class="col-md-4 mb-2">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">DESDE</div>
                                            </div>
                                            <input type ="date" name="from" value="{{isset($from) ? $from : $today}}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-2">
                                        <div class="input-group">	
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">HASTA</div>
                                            </div>
                                            <input type ="date" name="to" value="{{isset($to) ? $to : $today}}" class="form-control">	
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <button class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                    </div>
                                </div> <!-- end row-->
                            </form>
                            <div class="row">
                                <div class="col-md-12 table-responsive-md">
                                    <table class="table table-bordered table-sm data-table-inscriptions">
                                        <thead class="text-center">
                                        <tr>
                                            <th>N°</th>
                                            <th>Alumno</th>
                                            <th>Plan</th>
                                            <th>Fecha de inscripción</th>
                                            <th>Estado</th>
                                        </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            @foreach ($inscriptions as $ins)
                                                <tr>
                                                    <td>{{ $ins->id }}</td>
                                                    <td>{{ $ins->student->name }} {{ $ins->student->lastname }}</td>
                                                    <td>{{ $ins->plan->name }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($ins->registration_date)->format('d-m-Y') }}</td>
                                                    <td>{{ ucfirst($ins->state) }}</td>
                                                </tr>   
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center mt-2">
                                    <a href="{{ route('activities.index') }}" class="btn btn-secondary">Volver</a>
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