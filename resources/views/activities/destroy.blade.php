<div class="modal fade" id="modal-delete-{{$id}}" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ route('activities.destroy',$id) }}" method="POST">
            @method('DELETE')
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $state == 'activa' ? 'Desactivar Actividad' : 'Activar actividad' }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if ($state == 'activa')
                        <p>¿Está seguro que desea desactivar la actividad?</p>
                    @else
                        <p>¿Está seguro que desea activar la actividad?</p>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">{{ $state == 'activa' ? 'Desactivar' : 'Activar' }}</button>
                </div>
            </div>
        </form>
    </div>
</div>