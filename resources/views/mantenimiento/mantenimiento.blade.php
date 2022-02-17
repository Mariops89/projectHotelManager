@include('plantilla.header-movil')
<h1 class="text-center my-3">Lista de incidencias</h1>
@foreach($data['incidencias'] as $incidencia)
    <div class="card" id="{{$incidencia->id}}">
        <div class="card-body bg-secondary p-2 border-5">
            <div class="row">
                <div class="col d-flex flex-column">
                    <div class="fs-3">Habitación {{$incidencia->habitacion->numero}}</div>
                    <div class="fecha">{{ Carbon\Carbon::parse($incidencia->fecha_notificacion)->format('d/m/Y H:i:s')}}</div>
                </div>
                <div class="col text-end">
                    @switch($incidencia->Tipo)
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
                    {{$incidencia->descripcion}}
                </div>
            </div>
        </div>
    </div>
@endforeach
