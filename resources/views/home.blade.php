@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-6 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>Alumno</h3>
                            <p>Agregar Alumno</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-user-plus"></i>
                        </div>
                        <a href="{{ route('students.create')}}" class="small-box-footer">Hacer click aquí <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div><!-- ./col -->
            
                <div class="col-lg-6 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>Movimiento</h3>
                            <p>Registrar Movimiento</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-file-invoice-dollar"></i>
                        </div>
                        <a href="{{ route('movements.create')}}" class="small-box-footer">Hacer clik aquí  <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div><!-- ./col -->
            </div><!-- /.row -->
            <div class="row">
                <div class="col-lg-6 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-blue">
                        <div class="inner">
                            <h3>Asistencia</h3>
                            <p>Registrar Asistencia</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-user-check"></i>
                        </div>
                        <a href="{{ route('attendances.register')}}" class="small-box-footer">Hacer click aquí <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div><!-- ./col -->
            
                <div class="col-lg-6 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-olive">
                        <div class="inner">
                            <h3>Asistencia</h3>
                            <p>Listar Asistencias</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-list-ul"></i>
                        </div>
                        <a href="{{ route('attendances.index') }}" class="small-box-footer">Hacer clik aquí  <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div><!-- ./col -->
            </div><!-- /.row -->
        </div>
    </div>
</div>
@endsection
