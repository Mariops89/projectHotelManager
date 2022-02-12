<h1 class="text-center my-3">Incidencia {{$data->id}}</h1>

<div class="card mb-4">
    <div class="card-body bg-secondary p-2 border-5">
        <div class="row">
            <div class="col d-flex flex-column">
                <div class="fs-3">Habitación {{$data->habitacion->numero}}</div>
                <div class="fecha">{{ Carbon\Carbon::parse($data->fecha_notificacion)->format('d/m/Y H:i:s')}}</div>
            </div>
            <div class="col text-end">
                @switch($data->Tipo)
                    @case('urgente')
                    <span class="badge bg-danger fs-3">Urgente</span>
                    @break

                    @case('moderado')
                    <span class="badge bg-warning fs-3">Moderado</span>
                    @break

                    @case('no_urgente')
                    <span class="badge bg-success fs-3">No urgente</span>
                    @break
                @endswitch
            </div>
        </div>
        <div class="row mt-2">
            <div class="col">
                {{$data->descripcion}}
            </div>
        </div>
    </div>
</div>

<form method="post" action="{{url('mantenimiento/atender')}}">
    @csrf
    <input type="hidden" name="id" value="{{$data->id}}">

    @if (is_null($data->id_personal))
        <div class="row mb-4">
            <div class="col text-center">
                <div class="d-grid">
                    <button type="submit" name="tipo" value="atender" class="btn btn-lg btn-success fs-3 py-3 border-5">
                        <i class="fa fa-wrench"></i> Atender incidencia
                    </button>
                </div>
            </div>
        </div>
    @else
        <div class="row mb-4">
            <div class="col text-center">
                <div class="d-grid">
                    <button type="submit" name="tipo" value="resuelta" class="btn btn-lg btn-success fs-3 py-3 border-5">
                        <i class="fa fa-check"></i> Incidencia resuelta
                    </button>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col text-center">
                <div class="d-grid">
                    <button type="submit" name="tipo" value="pendiente" class="btn btn-lg btn-warning fs-3 py-3 border-5">
                        <i class="far fa-clock"></i> Incidencia pendiente
                    </button>
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="mb-3">
            <label for="incidencia-detalles" class="form-label">Detalles</label>
            <textarea class="form-control textarea" id="incidencia-detalles" name="detalles">{{$data->detalles}}</textarea>
        </div>
    </div>

    <div class="row">
        <div class="mb-3">
            <label for="incidencia-acciones" class="form-label">Acciones</label>
            <textarea class="form-control textarea" id="incidencia-acciones" name="acciones">{{$data->acciones}}</textarea>
        </div>
    </div>
</form>
