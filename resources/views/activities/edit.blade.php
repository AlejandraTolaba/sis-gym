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
                                <h4>Editar planes de {{$activity->name}}</h4>
                            </div>
                        </div>
                    </div>
                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
                            <form  action="{{ route('activities.update', $activity->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="plan_id">Planes</label>
                                        <select id="plans_id" name='plans_id[]' multiple="multiple" class="form-control plan select2_multiple shadow-sm @if($errors->first('plans_id[]')) is-invalid @endif" required>
                                            <!-- <option selected>{{''}}</option> -->
                                            @if ( !$plans->isEmpty() )
                                                @foreach ($plans as $plan)
                                                    <option value="{{$plan->id}}_{{$plan->name}}_{{$plan->classes}}" {{old('plan_id') == $plan->id ? 'selected' : ''}}>{{$plan->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <span class="invalid-feedback" role="alert">
                                            <strong> {{ $errors->first('plans_id[]', ':message') }} </strong>
                                        </span>
                                    </div>
                                    @include('activities.plans.create')
                                    <div class="form-group" id="plans_table">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="table table-bordered data-table" id="table">
                                                    <thead class="text-center">
                                                    <tr>
                                                        <th class="d-none">ID_Nombre_Clases</th>
                                                        <th>ID</th>
                                                        <th>Nombre del plan</th>
                                                        <th>Cantidad de clases</th>
                                                        <th width="170px">Precio</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody class="text-center" id="resultsTableBody">
                                                        @if ( !$activity->plans->isEmpty() )
                                                             @foreach ($activity->plans->sortBy('id') as $plan)
                                                                <tr id="row{{$plan->id}}"> 
                                                                    <td class="plan_id d-none">{{ $plan->id }}_{{ $plan->name }}_{{ $plan->classes }}</td>
                                                                    <td class="idColumn">{{ $plan->id }}</td>
                                                                    <td>{{ $plan->name }}</td>
                                                                    <td>{{ $plan->classes}}</td>
                                                                    <td><input type="number" id="prices" name="td_price[]" class="form-control text-center" value="{{$plan->pivot->price}}" required></td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <!-- <a href="{{ URL::previous() }}" class="btn btn-secondary">Cancelar</a> -->
                                        <a href="{{ route('activities.index') }}" class="btn btn-secondary">Cancelar</a>
                                        <button type="submit" class="btn btn-primary" id="btnSaveActivity">Guardar</button>
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