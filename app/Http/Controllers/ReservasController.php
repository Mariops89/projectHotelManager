<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuardarIncidenciaRequest;
use App\Models\Factura;
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
        $facturas = Factura::all();

        $plantilla->setTitle('Historial de reservas');
        $plantilla->setIcon('fas fa-calendar');
        $plantilla->setBreadcrumb(array('Reservas'));
        $plantilla->loadDatatables();
        $plantilla->loadSelect2();
        $plantilla->loadDaterangepicker();
        $plantilla->setCss('paginas/facturas/css/facturas.css'); //esto es el js, no la vista
        $plantilla->setJs('paginas/reservas/js/reservas.js'); //esto es el js, no la vista

        return $plantilla->load('reservas/reservas',
            ['habitaciones' => $habitaciones , 'facturas' => $facturas]);
             //cargo la vista y creo el array
    }


    public function listarAJAX(Request $request)
    {
        return Reserva::with(['habitacion', 'cliente', 'factura', 'factura.lineas'])
            ->intervalo($request->inicio, $request->fin)
            ->get()
            ->each(function ($reserva) {
                if (!is_null($reserva->factura)) {
                    $reserva->factura->subtotal = $reserva->factura->lineas->sum('base_imponible');
                    $reserva->factura->iva = $reserva->factura->lineas->sum('iva');
                    $reserva->factura->total = $reserva->factura->lineas->sum('subtotal');
                }
            });
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
