<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col text-end">
                        <button type="button" class="btn btn-success" id="nuevo-empleado">
                            <i class="fa fa-plus"></i> Nuevo empleado
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <table class="table table-striped table-bordered w-100" id="tabla-personal"></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="modal-empleado">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-personal">
                    <div class="row">
                        <div class="col-2">
                            <div class="mb-3">
                                <label for="empleado-dni" class="form-label">DNI</label>
                                <input type="text" class="form-control" id="empleado-dni" name="dni">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="empleado-nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="empleado-nombre" name="nombre">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="empleado-apellidos" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" id="empleado-apellidos" name="apellidos">
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="mb-3">
                                <label for="empleado-telefono" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="empleado-telefono" name="telefono">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="empleado-direccion" class="form-label">Dirección</label>
                                <input type="text" class="form-control" id="empleado-direccion" name="direccion">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="mb-3">
                                <label for="empleado-cod-postal" class="form-label">Código postal</label>
                                <input type="text" class="form-control" id="empleado-cod-postal" name="cod_postal">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="empleado-localidad" class="form-label">Localidad</label>
                                <input type="text" class="form-control" id="empleado-localidad" name="localidad">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="empleado-provincia" class="form-label">Provincia</label>
                                <input type="text" class="form-control" id="empleado-provincia" name="provincia">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="empleado-pais" class="form-label">País</label>
                                <input type="text" class="form-control" id="empleado-pais" name="pais">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="empleado-tipo" class="form-label">Tipo</label>
                                <select class="form-control" id="empleado-tipo" name="tipo">
                                    <option value="recepcionista">Recepcionista</option>
                                    <option value="mantenimiento">Mantenimiento</option>
                                    <option value="limpieza">Limpieza</option>
                                </select>
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
