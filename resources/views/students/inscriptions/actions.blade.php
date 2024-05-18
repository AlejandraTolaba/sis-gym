<a href="{{ route('inscriptions.show',$id) }}"><button title="Actualizar saldo" type="submit" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i> Saldo</button></a>
@if(Auth::user()->type =='A')
    <a href="{{ route('inscriptions.editExpiration',$id) }}"><button title="Actualizar vencimiento" type="submit" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i> Vencimiento</button></a>
    <a href="" id="Eliminar-{{$id}}" data-target="#modal-delete-{{$id}}" data-toggle="modal"><button class="btn btn-danger btn-sm" name="Eliminar-{{$id}}"><i class="fa fa-trash-alt"></i> Eliminar</button></a>
    @include('students.inscriptions.destroy')
@endif