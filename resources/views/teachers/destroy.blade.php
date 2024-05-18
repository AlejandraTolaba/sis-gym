<div class="modal fade" id="modal-delete-{{$id}}" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ route('teachers.destroy',$id) }}" method="POST">
            @method('DELETE')
            @csrf
            <div class="modal-content text-dark">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $state == 'activo' ? 'Desactivar Profesor' : 'Activar Profesor' }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if ($state == 'activo')
                        <p>¿Está seguro que desea desactivar el profesor?</p>
                    @else
                        <p>¿Está seguro que desea activar el profesor?</p>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">{{ $state == 'activo' ? 'Desactivar' : 'Activar' }}</button>
                </div>
            </div>
        </form>
    </div>
</div>