<?php

namespace App\Http\Controllers;

use App\Http\Requests\BuscarHabitacionesLibresRequest;
use App\Models\Habitacion;
use App\Models\Reserva;
use App\Models\TipoHabitacion;
use App\Services\PlantillaService;
use App\Services\ReservaService;

class ReservaController extends Controller
{

    public function mostrar(PlantillaService $plantilla)
    {
        $tipos_habitaciones = TipoHabitacion::all();

        $plantilla->setTitle('Reservas');
        $plantilla->setBreadcrumb(array('reservas', 'nueva'));
        $plantilla->loadDatatables();
        $plantilla->loadSelect2();
        $plantilla->loadDaterangepicker();
        $plantilla->setJs('paginas/reservas/js/nueva-reserva.js'); //esto es el js, no la vista
        return $plantilla->load('reservas/nueva-reserva', [
            'tipos_habitaciones' => $tipos_habitaciones
        ]); //la vista
    }


    public function buscarHabitacionesDisponiblesAJAX(BuscarHabitacionesLibresRequest $request)
    {
        $reserva = new ReservaService(
            $request->safe()->fecha_entrada,
            $request->safe()->fecha_salida,
            $request->safe()->idTipoHabitacion ?? null,
            $request->safe()->personas,
        );

        return $reserva->habitacionesDisponibles();
    }
}
