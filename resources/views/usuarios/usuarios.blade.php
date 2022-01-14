<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col text-end">
                        <button type="button" class="btn btn-success" id="nuevo-usuario">
                            <i class="fa fa-plus"></i> Nuevo Usuario
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <table class="table table-striped table-bordered w-100" id="tabla-usuarios"></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="modal-usuarios">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-usuarios">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="usuarios-usuario" class="form-label">Usuario</label>
                                <input type="text" class="form-control" id="usuarios-usuario" name="usuario">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="usuarios-password" class="form-label">Contraseña</label>
                                <input type="text" class="form-control" id="usuarios-password" name="password">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="usuarios-id_personal" class="form-label">Personal</label>
                                <select class="form-control" id="usuarios-id_personal" name="id_personal">
                                    <option></option>
                                    @foreach($data['personas'] as $persona)
                                        <option value="{{$persona->id}}">{{$persona->nombre}}</option>
                                    @endforeach
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
