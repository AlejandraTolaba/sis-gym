@if ($state !='inactiva')
    <a href="{{ route('activities.edit',$id) }}"><button name="Editar" title="Editar planes" type="submit" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i> Editar</button></a>
    <a href="{{route('showInscriptions',$id)}}"><button name="show" type="submit" title="Ver inscripciones" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Inscripciones</button></a>
    @if(Auth::user()->type =='A')
        <a href="" id="Eliminar-{{$id}}" data-target="#modal-delete-{{$id}}" data-toggle="modal"><button class="btn btn-danger btn-sm" name="Eliminar-{{$id}}"><i class="fa fa-times"></i> Desactivar</button></a>
        @include('activities.destroy')
    @endif
@else
    <a href="{{ route('activities.edit',$id) }}"><button disabled name="Editar" title="Editar planes" type="submit" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i> Editar</button></a>
    <a href="{{route('showInscriptions',$id)}}"><button disabled name="show" type="submit" title="Ver inscripciones" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Inscripciones</button></a>
    @if(Auth::user()->type =='A')
        <a href="" id="Eliminar-{{$id}}" data-target="#modal-delete-{{$id}}" data-toggle="modal"><button class="btn btn-success btn-sm" name="Eliminar-{{$id}}"><i class="fa fa-check"></i> Activar</button></a>
        @include('activities.destroy')
    @endif
@endif
