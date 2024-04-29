@extends('layouts.admin')

@section('content')
    @if(Session::has('success'))
        <div class="alert alert-success fade show col-md-6 offset-md-3" role="alert">
            {{Session::get('success')}}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger fade show col-md-6 offset-md-3" role="alert">  
            {{Session::get('error')}}
        </div>
    @endif
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-6 offset-md-3" id="accordion">
                <div class="card card-success card-outline">
                    <!-- <a class="d-block w-100" data-toggle="collapse" href="#collapseOne"> -->
                        <div class="card-header">
                            <div class="row text-center">
                                <div class="card-title col-md-12">
                                    <h4>{{ \Carbon\Carbon::parse(now())->formatLocalized('%d de %B de %Y') }}</h4>
                                </div>
                            </div>
                        </div>
                    <!-- </a> -->
                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
                            <form  action="{{ route('attendances.showStudent') }}" method="GET">
                                <!-- {{ csrf_field() }} -->
                                <input type="text" class="form-control mb-4" name="searchText" placeholder="Ingrese DNI..." autofocus>          
                                <div class="row">
                                    <div class="col-md-12 text-center mt-2">
                                        <button type="submit" class="btn btn-primary" id="btn">Registrar Asistencia</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection


