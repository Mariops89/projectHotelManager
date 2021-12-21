<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col text-end">
                        <button type="button" class="btn btn-success" id="nueva-habitacion">
                            <i class="fa fa-plus"></i> Nueva habitación
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <table class="table table-striped table-bordered w-100" id="tabla-habitaciones"></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-habitaciones">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-habitaciones">
                    <div class="row">
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="habitaciones-numero" class="form-label">Número de habitación</label>
                                <input type="text" class="form-control" id="habitaciones-numero" name="numero">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="habitaciones-tipo" class="form-label">Tipo de habitación</label>
                                <select class="form-control" id="habitaciones-tipo" name="id_tipo_habitacion">
                                    @foreach($data['tipos'] as $tipo)
                                        <option value="{{$tipo->id}}">{{$tipo->tipo}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="habitaciones-personas" class="form-label">Número de personas</label>
                                <input type="number" class="form-control" id="habitaciones-personas" name="personas">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="habitaciones-estado" class="form-label">Estado actual</label>
                                <select class="form-control" id="habitaciones-estado" name="estado">
                                    <option value="activa">Activa</option>
                                    <option value="inactiva">Inactiva</option>
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

