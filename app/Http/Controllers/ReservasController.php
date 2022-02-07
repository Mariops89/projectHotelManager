<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuardarIncidenciaRequest;
use App\Models\Habitacion;
use App\Models\Reserva;
use App\Services\PlantillaService;
use Carbon\Carbon;
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
            Reserva::find($request->id)->update($request->validated());
            dd($_POST);
        }

    }

    public function guardarCheckin (Request $request)
    {
        //$array = $request;
        //$array ['timestamp_salida'] = Carbon::now();

        Reserva::find($request->id)->update(['timestamp_entrada' => Carbon::now()]);
    }

    public function guardarCheckout (Request $request)
    {
        //$array = $request;
        //$array ['timestamp_salida'] = Carbon::now();

        Reserva::find($request->id)->update(['timestamp_salida' => Carbon::now()]);
        //dd($array);
    }

    public function eliminar(Request $request)
    {
        Reserva::destroy($request->id);
    }
}
