ti<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col text-end">
                        <button type="button" class="btn btn-success" id="nuevo-tipo">
                            <i class="fa fa-plus"></i> Nuevo tipo
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <table class="table table-striped table-bordered w-100" id="tabla-tipo_habitacion"></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-tipo_habitacion">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-tipo_habitacion">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="tipo_habitacion-tipo" class="form-label">Tipo de habitación</label>
                                <input type="text" class="form-control" id="tipo_habitacion-tipo" name="tipo">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="tipo_habitacion-precio_alta" class="form-label">Precio en temporada alta</label>
                                <input type="number" class="form-control" id="tipo_habitacion-precio_alta" name="precio_alta">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="tipo_habitacion-precio_baja" class="form-label">Precio en temporada baja</label>
                                <input type="number" class="form-control" id="tipo_habitacion-precio_baja" name="precio_baja">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fa fa-times"></i> Cerrar
                </button>
                <button type="button" class="btn btn-success aceptar">
                    <i class="fa fa-check"></i> Aceptar
                </button>
            </div>
        </div>
    </div>
</div>

