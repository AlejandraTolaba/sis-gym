@extends('layouts.admin')
@push('scripts')

@endpush

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-6 offset-md-3" id="accordion">
                <div class="card card-success card-outline">
                    <!-- <a class="d-block w-100" data-toggle="collapse" href="#collapseOne"> -->
                        <div class="card-header">
                            <div class="row text-center">
                                <div class="card-title col-md-12">
                                    <h4>{{ $inscription->student->name}} {{ $inscription->student->lastname}}</h4>
                                </div>
                            </div>
                        </div>
                    <!-- </a> -->
                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="text-center p-2 alert alert-secondary alert-important">
                                        <h4>{{ $inscription->activity->name }}</h4> <!-- ;font-size:300% -->
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table" id="table">
                                            <tr>
                                                <th style="width:50%">Plan</th> <!-- ;font-size:200% -->
                                                <td >{{ $inscription->plan->name }}</td> <!-- style="font-size:200%" -->
                                            </tr>
                        
                                            <tr>
                                                <th >Fecha de Vencimiento</th> <!-- style="font-size:200%" --> 
                                                <td > <?php $fv = new DateTime($inscription->expiration_date); echo $fv->format('d-m-Y');?></td>
                                            </tr>

                                            <tr>
                                                <th>Clases restantes</th>
                                                <td>{{ $inscription->classes }} clases</td>
                                            </tr>

                                            <tr>
                                                @if($inscription->balance > 0)
                                                    <th class = "danger text-danger">Saldo</th>
                                                    <td class = "danger text-danger"><b>$<?=number_format($inscription->balance,2,',','.') ?></b></td>
                                                @endif
                                            </tr>
                                        </table> 
                                    </div><!-- table-responsive -->
                                </div><!-- /.col -->
                            </div> <!-- /.row -->
                            <div class="row">
                                <div class="col-md-12 text-center mt-2">
                                    <a href="{{ URL::previous() }}" class="btn btn-secondary" autofocus>Volver</a>
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


