<?php

namespace App\Http\Controllers;

use App\Http\Requests\BuscarHabitacionesLibresRequest;
use App\Models\Cliente;
use App\Models\Habitacion;
use App\Models\Reserva;
use App\Models\TipoHabitacion;
use App\Services\PlantillaService;
use App\Services\ReservaService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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
        $plantilla->setCss('paginas/reservas/css/nueva-reserva.css');
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


    public function buscarClienteAJAX(Request $request)
    {
        return json_encode(Cliente::firstWhere('dni', $request->dni));
    }


    public function confirmarReservaAJAX(Request $request)
    {
        $fechas = explode(' - ', $request->fechas);

        Reserva::create([
            'id_cliente' => $request->id_cliente,
            'id_habitacion' => $request->id_habitacion,
            'personas' => $request->personas,
            'precio' => $request->precio,
            'fecha_entrada' => Carbon::createFromFormat('d/m/Y', $fechas[0])->toDateString(),
            'fecha_salida' => Carbon::createFromFormat('d/m/Y', $fechas[1])->toDateString(),
            'late_checkout' => 0
        ]);
    }
}
