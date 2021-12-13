<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col text-end">
                        <button type="button" class="btn btn-success">
                            <i class="fa fa-plus"></i> Nuevo Cliente
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <table class="table table-striped table-bordered w-100" id="tabla-clientes"></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="modal-clientes">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-2">
                            <div class="mb-3">
                                <label for="cliente-dni" class="form-label">DNI</label>
                                <input type="text" class="form-control" id="cliente-dni" name="dni">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="cliente-nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="cliente-nombre" name="nombre">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="cliente-apellidos" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" id="cliente-apellidos" name="apellidos">
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="mb-3">
                                <label for="cliente-telefono" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="cliente-telefono" name="telefono">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="cliente-direccion" class="form-label">Dirección</label>
                                <input type="text" class="form-control" id="cliente-direccion" name="direccion">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="mb-3">
                                <label for="cliente-cod-postal" class="form-label">Código postal</label>
                                <input type="text" class="form-control" id="cliente-cod-postal" name="cod_postal">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="cliente-localidad" class="form-label">Localidad</label>
                                <input type="text" class="form-control" id="cliente-localidad" name="localidad">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="cliente-provincia" class="form-label">Provincia</label>
                                <input type="text" class="form-control" id="cliente-provincia" name="provincia">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="cliente-pais" class="form-label">País</label>
                                <input type="text" class="form-control" id="cliente-pais" name="pais">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fa fa-times"></i> Cerrar
                </button>
                <button type="button" class="btn btn-success">
                    <i class="fa fa-check"></i> Aceptar
                </button>
            </div>
        </div>
    </div>
</div>
