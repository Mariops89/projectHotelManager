<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuardarIncidenciaRequest;
use App\Models\Habitacion;
use App\Models\Incidencia;
use App\Models\Cliente;
use App\Models\Reserva;
use App\Services\PlantillaService;
use Illuminate\Http\Request;

class ReservasController
{
    public function listar(PlantillaService $plantilla)
    {
        $habitaciones = Habitacion::all();

        $plantilla->setTitle('Historial de reservas');
        $plantilla->setBreadcrumb(array('Reservas'));
        $plantilla->loadDatatables();
        $plantilla->loadSelect2();
        $plantilla->setJs('paginas/reservas/js/reservas.js'); //esto es el js, no la vista

        return $plantilla->load('reservas/reservas',
            ['habitaciones' => $habitaciones]);
             //cargo la vista y creo el array
    }


    public function listarAJAX()
    {
        return Reserva::with(['habitacion', 'cliente'])->get();
    }


    public function guardar(GuardarIncidenciaRequest $request)
    {
        if (is_null($request->id)) {
            //crear
           // $array = $request->validated();
           // $array ['fecha_notificacion'] = Carbon::now();
            Reserva::create($request->validated());
        } else {
            //editar
            Reserva::where('id', $request->id)->update($request->validated());
        }

    }


    public function eliminar(Request $request)
    {
        Reserva::destroy($request->id);
    }
}
