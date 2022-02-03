<div class="card" id="card-buscar">
    <div class="card-body">
        <form id="form-buscar">
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="reserva-fechas" class="form-label">Entrada - Salida</label>
                        <input type="text" class="form-control" id="reserva-fechas" name="fechas">
                    </div>
                </div>
                <div class="col">
                    <label for="reserva-tipo-habitacion" class="form-label">Tipo de habitación</label>
                    <select class="form-control" id="reserva-tipo-habitacion" name="idTipoHabitacion[]" multiple>
                        <option></option>
                        @foreach($data['tipos_habitaciones'] as $tipo)
                            <option value="{{$tipo->id}}">{{$tipo->tipo}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="reserva-personas" class="form-label">Personas</label>
                        <input type="number" class="form-control" id="reserva-personas" name="personas">
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label class="form-label">&nbsp;</label>
                        <button type="button" class="btn btn-success form-control" id="buscar">
                            <i class="fas fa-search"></i> Buscar
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Habitaciones disponibles</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <table class="table table-striped table-bordered w-100" id="tabla-habitaciones-disponibles"></table>
            </div>
        </div>
    </div>
</div>


<div class="card" id="card-cliente" style="display: none">
    <div class="card-header">
        <h4 class="card-title">Cliente</h4>
    </div>
    <div class="card-body">
        <form id="form-buscar">
            <div class="row">
                <div class="col-3">
                    <div class="mb-3">
                        <label for="reserva-cliente-dni" class="form-label">DNI</label>
                        <input type="text" class="form-control" id="reserva-cliente-dni">
                    </div>
                </div>
                <div class="col-3">
                    <div class="mb-3">
                        <label class="form-label">&nbsp;</label>
                        <button type="button" class="btn btn-success form-control" id="buscar-cliente">
                            <i class="fas fa-search"></i> Buscar cliente
                        </button>
                    </div>
                </div>
                <div class="col-3">
                    <div class="mb-3">
                        <label class="form-label">&nbsp;</label>
                        <button type="button" class="btn btn-secondary form-control" id="nuevo-cliente">
                            <i class="fas fa-plus"></i> Nuevo cliente
                        </button>
                    </div>
                </div>
            </div>
            <div>
                <h5 id="cliente-no-encontrado" style="display: none">Cliente no encontrado</h5>
                <div id="datos-cliente" style="display: none">
                    <div class="row">
                        <div class="col">
                            <div><label>DNI: </label> <span class="dni"></span></div>
                            <div><label>Nombre: </label> <span class="nombre"></span></div>
                            <div><label>Apellidos: </label> <span class="apellidos"></span></div>
                            <div><label>Teléfono: </label> <span class="telefono"></span></div>
                        </div>
                        <div class="col">
                            <div><label>Dirección: </label> <span class="direccion"></span></div>
                            <div><label>Localidad: </label> <span class="localidad"></span></div>
                            <div><label>Código postal: </label> <span class="cp"></span></div>
                            <div><label>Provincia: </label> <span class="provincia"></span></div>
                            <div><label>País: </label> <span class="pais"></span></div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-3 mt-3">
                            <button type="button" class="btn btn-success form-control" id="confirmar-reserva">
                                <i class="fas fa-check"></i> Confirmar reserva
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>


<div class="modal fade" id="modal-confirmacion">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <div>
                    <i class="fas fa-check-circle text-success" style="font-size: 90px"></i>
                </div>
                <h3 class="my-4">Reserva confirmada</h3>
                <a href="{{url('reservas/nueva')}}" type="button" class="btn btn-secondary">
                    <i class="fa fa-times"></i> Cerrar
                </a>
            </div>
        </div>
    </div>
</div>
