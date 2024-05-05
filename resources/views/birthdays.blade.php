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
                            <div class="card-deck justify-content-center align-items-center">
                                @foreach ( $students as $student )
                                    <div class="row row-cols-1 row-cols-md-3">
                                        <div class="col mb-4">
                                            <div class="card" style="width: 170px;">
                                                <img src="/img/students/{{ $student->photo }}" class="card-img-top" alt="...">
                                                <div class="card-body text-center">
                                                    <h5>{{ $student->name }} {{ $student->lastname }}</h5>
                                                    <p class="card-text">{{ \Carbon\Carbon::createFromDate($student->birthdate)->age }} años</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @foreach ( $teachers as $teacher )
                                    <div class="row row-cols-1 row-cols-md-3">
                                        <div class="col mb-4">
                                            <div class="card" style="width: 170px;">
                                                <img src="/img/teachers/{{ $teacher->photo }}" class="card-img-top" alt="...">
                                                <div class="card-body text-center">
                                                    <h5>{{ $teacher->name }} {{ $teacher->lastname }}</h5>
                                                    <p class="card-text">{{ \Carbon\Carbon::createFromDate($teacher->birthdate)->age }} años</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
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