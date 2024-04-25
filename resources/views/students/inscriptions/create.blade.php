@extends('layouts.admin')
@push('scripts')
<script>
    $(document).ready(function(){
        $('#activity_id').change(function(){
            $.get("{{ url('dropdown')}}",
            { option: $(this).val() },
            function(data) {
                $('#plan_id').empty();
                $('#plan_id').append("<option value=0 selected> Seleccione un plan </option>");
                $.each(data, function(key, element) {
                    $('#plan_id').append("<option value='" + key+"'>" + element + "</option>");
                });
            });
        });
        $('#plan_id').change(function(){
            data=$('#plan_id').val().split('_');
		    $('#price').val(data[1]);
            // console.log(data[0]);
        });
    });	
        
</script>
@endpush
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-8 col-md-12 offset-md-2" id="accordion">
                <div class="card card-success card-outline">
                    <!-- <a class="d-block w-100" data-toggle="collapse" href="#collapseOne"> -->
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12 card-title text-center">
                                <h4>Nueva Inscripción</h4>
                            </div>
                        </div>
                    </div>
                    <!-- </a> -->
                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
                            <form  action="{{ route('inscriptions.store', $student->id) }}" method="POST">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="form-row w-100">
                                        <div class="col-md-9 mb-3">
                                            <label for="name">Nombre del alumno</label>
                                            <input class="form-control"
                                            id="name"
                                            type="text"
                                            name="name"
                                            value="{{$student->name.' '.$student->lastname}}"
                                            disabled>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="registration_date">Fecha de inscripción</label>                   
                                            <input class="form-control bg-ligth shadow-sm @if($errors->first('registration_date')) is-invalid @endif"
                                            id='input_registration_date'
                                            type ="date" 
                                            name="registration_date" 
                                            value="{{old('registration_date')}}">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong> {{ $errors->first('registration_date', ':message') }} </strong>
                                                </span>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-5 mb-3">
                                            <input type="hidden" id="id_activity" class="form-control" >
                                            <div class="form-group">
                                                <label for="activity_id">Actividad</label>
                                                <select id="activity_id" name='activity_id' class="form-control activity select2 shadow-sm @if($errors->first('activity_id')) is-invalid @endif" >
                                                    <option selected>Seleccione una actividad</option>
                                                    @foreach ($activities as $activity)
                                                        <option value="{{$activity->id}}" {{old('activity_id') == $activity->id ? 'selected' : ''}}>{{$activity->name}}</option>
                                                    @endforeach
                                                </select>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong> {{ $errors->first('activity_id', ':message') }} </strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="form-group">
                                                <label for="plan_id">Plan</label>
                                                <select id="plan_id" name='plan_id' class="form-control activity select2 shadow-sm @if($errors->first('plan_id')) is-invalid @endif" >
                                                    
                                                </select>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong> {{ $errors->first('plan_id', ':message') }} </strong>
                                                </span>
                                            </div>
                                        </div>
                                       
                                        <div class="col-md-3">
                                            <label for="price">Precio</label>
                                            <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">$</div>
                                                    </div>
                                                    <input type="number" step = "any" class="form-control" id="price" name="price" disabled>
                                                </div>
                                        </div>
                                    </div>    
                                
                                    <div class="form-row">
                                        <div class="col-md-9 mb-3">
                                            <div class="form-group">
                                                <label for="method_of_payment_id">Forma de pago</label>
                                                <select id="method_of_payment_id" name='method_of_payment_id' class="form-control activity select2 shadow-sm @if($errors->first('method_of_payment_id')) is-invalid @endif" >
                                                    <option selected>Seleccione forma de pago</option>
                                                    @foreach ($methods_of_payment as $method_of_paymen)
                                                        <option value="{{$method_of_paymen->id}}" {{old('method_of_payment_id') == $method_of_paymen->id ? 'selected' : ''}}>{{$method_of_paymen->name}}</option>
                                                    @endforeach
                                                </select>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong> {{ $errors->first('method_of_payment_id', ':message') }} </strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="amount">Monto</label>
                                            <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">$</div>
                                                    </div>
                                                    <input type="number" step = "any" class="form-control" id="amount" name="amount">
                                                </div>
                                        </div>
                                    </div>                     
                                    
                                    <div class="row">
                                        <div class="col-md-12 text-center mt-3">
                                            <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancelar</a>
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
