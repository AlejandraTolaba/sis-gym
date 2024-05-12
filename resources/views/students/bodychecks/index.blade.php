@extends('layouts.admin')

@section('content')
    @if (session()->has('info'))
        <div class="alert alert-success alert-dismissible fade show col-md-12" role="alert">
            <strong>{{session('info')}}</strong>
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
                                    <h4>Fichas de control corporal</h4>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="{{ route('bodychecks.create', $student->id) }}"><button class="btn btn-success" title="Agregar ficha de control corporal"><i class="fa fa-plus"></i> Agregar</button></a>
                                </div>
                            </div>
                        </div>
                    <!-- </a> -->
                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-12 card-title text-center">
                                    <h4>{{ $student->name }} {{ $student->lastname}}</h4>
                                    <div class="text-center">
                                        <img src="{{asset('img/students/'.$student->photo)}}" width="80px" height="80px" class="rounded-circle" alt="photo-student">
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="row"> -->
                                @if ($student->bodychecks->isNotEmpty())
                                    <div class="col-md-12 table-responsive-md">
                                        <table class="table table-bordered table-sm data-table-bodycheck">
                                            <thead class="text-center">
                                            <tr>
                                                <th>Fecha</th>
                                                <th>Peso</th>
                                                <th>Edad corporal</th>
                                                <th>IMC</th>
                                                <th>Grasa corporal</th>
                                                <th>IMM</th>
                                                <th>MB</th>
                                                <th>Grasa visceral</th>
                                                <th>Opciones</th>
                                            </tr>
                                            </thead>
                                            <tbody class="text-center">
                                                @foreach ($student->bodychecks as $bc)
                                                    <tr>
                                                        <td>{{$bc->created_at ? $bc->created_at->format('m-Y') : '-'}}</td>
                                                        <td>{{$bc->weight}} kg</td>
                                                        <td>{{$bc->body_age}}</td> 
                                                        <td>{{$bc->imc}}</td>
                                                        <td>{{$bc->body_fat}}</td>
                                                        <td>{{$bc->imm}}</td>
                                                        <td>{{$bc->mb}}</td> 
                                                        <td>{{$bc->visceral_fat}}</td>
                                                        <td>
                                                        <a href="{{ route('bodychecks.edit',$bc->id) }}"><button title="Editar ficha" type="submit" class="btn btn-warning"><i class="fas fa-pencil-alt"></i> Editar</button></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="text-center alert alert-secondary alert-important">
                                        Sin fichas de control corporal
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