<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col text-end">
                        <button type="button" class="btn btn-success" id="nuevo-servicio">
                            <i class="fa fa-plus"></i> Nuevo Servicio
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <table class="table table-striped table-bordered w-100" id="tabla-servicios"></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="modal-servicios">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-servicios">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="servicio-nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="servicio-nombre" name="nombre">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="servicio-estado" class="form-label">Estado</label>
                                <select class="form-control" id="servicio-estado" name="estado">
                                    <option value="activo">Activo</option>
                                    <option value="inactivo">Inactivo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="servicio-plazas" class="form-label">Plazas</label>
                                <input type="text" class="form-control" id="servicio-plazas" name="plazas">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="servicio-precio" class="form-label">Precio</label>
                                <input type="text" class="form-control" id="servicio-precio" name="precio">
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
