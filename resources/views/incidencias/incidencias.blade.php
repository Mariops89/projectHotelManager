<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col text-end">
                        <button type="button" class="btn btn-success" id="nueva-incidencia">
                            <i class="fa fa-plus"></i> Nueva Incidencia
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <table class="table table-striped table-bordered w-100" id="tabla-incidencias"></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="modal-incidencias">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-incidencias">
                    <div class="row">
                        <div class="col-2">
                            <div class="mb-3">
                                <label for="incidencia-tipo" class="form-label">Tipo de incidencia</label>
                                <select class="form-control" id="incidencia-tipo" name="incidencia-tipo">
                                    <option value="urgente">Urgente</option>
                                    <option value="moderado">Moderada</option>
                                    <option value="no_urgente">No urgente</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="incidencia-descripcion" class="form-label">Descripción</label>
                                <input type="text" class="form-control" id="incidencia-descripcion" name="descripcion">
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="mb-3">
                                <label for="incidencia-fecha_notificacion" class="form-label">Fecha de notificación</label>
                                <input type="text" class="form-control" id="incidencia-fecha_notificacion" name="fecha_notificacion">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="incidencia-fecha_resolucion" class="form-label">Fecha de resolución</label>
                                <input type="text" class="form-control" id="incidencia-fecha_resolucion" name="fecha_resolucion">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="mb-3">
                                <label for="incidencia-detalles" class="form-label">Detalles</label>
                                <input type="textarea" class="form-control" id="incidencia-detalles" name="detalles">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="incidencia-acciones" class="form-label">Acciones</label>
                                <input type="textarea" class="form-control" id="incidencia-acciones" name="acciones">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="incidencia-id_personal" class="form-label">id_personal</label>
                                <input type="text" class="form-control" id="incidencia-id_personal" name="id_personal">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="incidencia-id_habitacion" class="form-label">id_habitacion</label>
                                <input type="text" class="form-control" id="incidencia-id_habitacion" name="id_habitacion">
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

