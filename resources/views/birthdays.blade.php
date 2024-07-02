@extends('layouts.admin')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-6 offset-md-3" id="accordion">
                <div class="card card-success card-outline">
                    <!-- <a class="d-block w-100" data-toggle="collapse" href="#collapseOne"> -->
                        <div class="card-header text-center">
                            <div class="row">
                                <div class="col-md-3">
                                    <img src="{{asset('img/balloons.png')}}" width="100px">    
                                </div>
                                <div class="col md-6 align-self-center">
                                    <span class="h3 text-bold">Cumpleaños de hoy</span> 
                                    <p class="h4 mt-2 text-bold">{{ \Carbon\Carbon::parse(now())->formatLocalized('%d de %B de %Y') }}</p>
                                </div>
                                <div class="col-md-3">
                                    <img src="{{asset('img/balloons.png')}}" width="100px">    
                                </div>
                            </div>
                            <!--  -->
                    <!-- </a> -->
                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
                            @if ($students->isNotEmpty() || $teachers->isNotEmpty())
                                <div class="col-md-8 offset-md-2">
                                    <table class="table table-bordered table-condensed table-hover text-center">
                                        <tbody>
                                            @foreach ( $students as $student )
                                                <tr>
                                                    <td>
                                                        <div class="media align-items-center">
                                                                <div class="media-left mr-2">
                                                                    <img src="{{asset('img/students/'.$student->photo)}}" class="media-object" alt="..." style="border:1px solid #b0b8b9;" height="100px" width="100px">
                                                                </div>
                                                            <div class="media-body">
                                                                <h5>{{ $student->name }} {{ $student->lastname }}</h5>
                                                                <p>{{ \Carbon\Carbon::createFromDate($student->birthdate)->age }} años</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>   
                                            @endforeach
                                            @foreach ( $teachers as $teacher )
                                                <tr>
                                                    <td>
                                                        <div class="media align-items-center">
                                                                <div class="media-left mr-2">
                                                                    <img src="{{asset('img/teachers/'.$teacher->photo)}}" class="media-object" alt="..." style="border:1px solid #b0b8b9;" height="100px" width="100px">
                                                                </div>
                                                            <div class="media-body">
                                                                <h5>{{ $teacher->name }} {{ $teacher->lastname }}</h5>
                                                                <p>{{ \Carbon\Carbon::createFromDate($teacher->birthdate)->age }} años</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>   
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="alert alert-secondary alert-important text-center">
                                    No hay cumpleaños
                                </div>
                            @endif
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection