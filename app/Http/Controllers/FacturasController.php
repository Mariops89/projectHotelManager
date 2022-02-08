<?php

namespace App\Http\Controllers;
use App\Http\Requests\GuardarFacturaRequest;
use App\Http\Requests\GuardarIncidenciaRequest;
use App\Models\Factura;
use App\Models\Reserva;
use App\Services\PlantillaService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class FacturasController
{
    public function listar(PlantillaService $plantilla)
    {
        $reservas = Reserva::all();

        $plantilla->setTitle('Historial de facturas');
        $plantilla->setBreadcrumb(array('Facturas'));
        $plantilla->loadDatatables();
        $plantilla->loadDaterangepicker();
        $plantilla->loadSelect2();
        $plantilla->setJs('paginas/facturas/js/facturas.js'); //esto es el js, no la vista

        return $plantilla->load('facturas/facturas',
            ['reservas' => $reservas]);
        //cargo la vista y creo el array
    }

    public function listarAJAX()
    {
        return Factura::with(['habitacion', 'cliente'])->get();
    }


    public function guardar(GuardarFacturaRequest $request)
    {
        $fecha = explode(' - ', $request->fecha);


        if (is_null($request->id)) {
            //crear
            // $array = $request->validated();
            // $array ['fecha_notificacion'] = Carbon::now();
            dd($request->all());
            Factura::create($request->validated());
        } else {
            //editar
            Factura::find($request->id)->update($request->validated());
        }

    }


    public function eliminar(Request $request)
    {
        Factura::destroy($request->id);
    }
}
