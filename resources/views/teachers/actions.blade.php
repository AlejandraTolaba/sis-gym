<a href="{{ route('teachers.show',$id) }}"><button {{ $state !='activo' ? 'disabled' : '' }} name="show-dates" title="Ver datos de profesor" type="submit" class="btn btn-success btn-sm"><i class="fa fa-user"></i> Visualizar</button></a>
<a href="{{ route('teachers.edit',$id) }}"><button {{ $state !='activo' ? 'disabled' : '' }} name="edit" title="Editar profesor" type="submit" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i> Editar</button></a>
@if(Auth::user()->type =='A')
    <a href="" id="Eliminar-{{$id}}" data-target="#modal-delete-{{$id}}" data-toggle="modal"><button class="{{ $state !='activo' ? "btn btn-success btn-sm" : "btn btn-danger btn-sm" }}" title="{{ $state !='activo' ? 'Activar profesor' : 'Desactivar profesor' }}"><i class="{{ $state !='activo' ? 'fa fa-check' : 'fa fa-times' }}"></i> {{ $state !='activo' ? 'Activar' : 'Desactivar' }}</button></a>
    @include('teachers.destroy')
@endif