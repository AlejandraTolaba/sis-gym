@extends('layouts.admin')
@push('scripts')
    <script>
        $(document).ready(function(){
            $('#activity').change(function(){
                $.get("{{ url('dropdown2')}}",
                { option: $(this).val() },
                function(data) {
                    // console.log(data);
                    $('#t-body').empty();
                    $('#count').val(data.length);
                    $.each(data, function(key, element) {
                        // console.log(data.length);
                        var row = '<tr class="select"> <td><input type="hidden" name="alumnos[]" value="'+key+'">'+element+'</td></tr>';
                        $('#t-body').append(row)            
                    });
                });
                const currentDate = "<?php echo date('Y-m-d');?>";
                $('#date').val(currentDate);
            });
        });	
    </script>
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
                                    <h4>Asistencias</h4>
                                </div>
                            </div>
                        </div>
                    <!-- </a> -->
                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
                            <form  action="{{ route('attendances.byDay') }}" method="GET">
                                <!-- {{ csrf_field() }} -->
                                <div class="row mb-3">
                                    <div class="col">
                                        <select id="activity" name="activity" class="form-control select2" data-placeholder="Seleccione una actividad">
                                            <option></option>
                                            @foreach ($activities as $act)
                                                @if ( isset($activity) && $activity == $act->id)
                                                    <option value="{{$act->id}}" selected>{{$act->name}}</option>
                                                @else
                                                    <option value="{{$act->id}}" {{ old('activity') == $act->id ? "selected" :""}}>{{$act->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">FECHA</div>
                                            </div>
                                            <input type ="date" name="date" id="date" value="{{ $date }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <button class="btn btn-primary" title="Filtar"><i class="fa fa-calendar"></i></button>
                                    </div>
                                    <div class="col-md-5" align="right">
                                        <h4 name="cant">Total: <input type ="number" id="count" value="{{$attendances->count()}}" style="border:none; width:30%" readonly></h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="table-responsive">
                                            <table class="display table" cellspacing="0" width="100%" style="border-bottom:2px solid #D8D8D8; border-top:2px solid #D8D8D8">
                                                <thead>
                                                    <th>NOMBRE DEL ALUMNO</th>
                                                </thead>
                                                <tbody id="t-body">
                                                    @if ($attendances->isNotEmpty())
                                                        @foreach ($attendances as $a)
                                                            <tr>
                                                                <td>{{ $a->inscription->student->name }} {{ $a->inscription->student->lastname }}</td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td width="100%">-</td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
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


