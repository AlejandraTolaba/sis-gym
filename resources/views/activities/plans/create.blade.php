<div class="modal fade" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title text-center" id="exampleModalLabel">Nuevo Plan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body">
                <input type="hidden" id="id_plan" class="form-control" >
                <div class="form-group">
                    <label for=plan_name">Nombre</label>
                    <input class="form-control bg-ligth shadow-sm input-validate"
                    id="plan_name"
                    type="text"
                    name="plan_name"
                    placeholder="Ingrese nombre del plan"
                    >
                </div>

                <div class="form-group">
                    <label for="classes">Cantidad de clases</label>
                    <input class="form-control bg-ligth shadow-sm input-validate"
                    id='classes'
                    type="number"
                    name="classes"
                    placeholder="Ingrese cantidad de clases"
                    value="{{''}}">
                </div>
                    
                <div class="row d-none" id="btns_create_plan">
                    <div class="col-md-12 text-center mt-3">
                        <a data-dismiss="modal" class="btn btn-secondary">Cancelar</a>
                        <button data-dismiss="modal" class="btn btn-primary" id="btnSavePlan" name="btnSavePlan" onclick="setTimeout('addPlan()',1000);">Guardar</button>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>