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
    <div class="card-body">
        <div class="row">
            <div class="col">
                <table class="table table-striped table-bordered w-100" id="tabla-habitaciones-disponibles"></table>
            </div>
        </div>
    </div>
</div>
