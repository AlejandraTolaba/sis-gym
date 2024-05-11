@extends('layouts.admin')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-8 col-md-12 offset-md-2" id="accordion">
                <div class="card card-success card-outline">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h4>Nueva Actividad</h4>
                            </div>
                        </div>
                    </div>
                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
                            <form  action="{{ route('activities.store') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Nombre</label>
                                        <input class="form-control bg-ligth shadow-sm @if($errors->first('name')) is-invalid @endif"
                                        id="title"
                                        type="text"
                                        name="name"
                                        placeholder="Ingrese nombre de la actividad"
                                        value="{{old('name')}}">
                                            <span class="invalid-feedback" role="alert">
                                                <strong> {{ $errors->first('name', ':message') }} </strong>
                                            </span>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="plan_id">Planes</label>
                                        <select id="plans_id" name='plans_id[]' multiple="multiple" class="form-control plan select2_multiple shadow-sm @if($errors->first('plan_id')) is-invalid @endif" >
                                            <!-- <option selected>{{''}}</option> -->
                                            @if ( !$plans->isEmpty() )
                                                @foreach ($plans as $plan)
                                                    <option value="{{$plan->id}}_{{$plan->name}}_{{$plan->classes}}" {{old('plan_id') == $plan->id ? 'selected' : ''}}>{{$plan->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <span class="invalid-feedback" role="alert">
                                            <strong> {{ $errors->first('plan_id', ':message') }} </strong>
                                        </span>
                                    </div>
                                    @include('activities.plans.create')
                                      
                                    <div class="form-group d-none" id="plans_table">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="table table-bordered table-sm" id="table">
                                                    <thead class="text-center">
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Nombre del plan</th>
                                                        <th>Cantidad de clases</th>
                                                        <th width="170px">Precio</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody class="text-center" id="resultsTableBody">
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center mt-2">
                                        <!-- <a href="{{ URL::previous() }}" class="btn btn-secondary">Cancelar</a> -->
                                        <a href="{{ route('activities.index') }}" class="btn btn-secondary">Cancelar</a>
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </div>
                                </div>
                                <!-- /.card-body -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
@push('scripts')
    <script src="{{asset('js/select2.js')}}"></script>
    <script src="{{asset('js/add_plan.js')}}"></script>
@endpush