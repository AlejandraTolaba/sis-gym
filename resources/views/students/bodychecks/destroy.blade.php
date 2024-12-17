<div class="modal fade" id="modal-delete-{{$bc->id}}" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ route('bodychecks.destroy',$bc->id) }}" method="POST">
            @method('DELETE')
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Eliminar ficha de control corporal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>¿Está seguro que desea eliminar la ficha de control?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" name="Confirm-{{$bc->id}}">Eliminar</button>
                </div>
            </div>
        </form>
    </div>
</div>