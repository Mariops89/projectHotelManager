<?php

namespace App\Http\Controllers;

use App\Models\TipoHabitacion;
use App\Services\PlantillaService;
use Illuminate\Http\Request;

class TipoHabitacionesController extends Controller
{

    public function listar(PlantillaService $plantilla)
    {
        $plantilla->setTitle('Tipo de habitaciones');
        $plantilla->setBreadcrumb(array('tipo-habitaciones'));
        $plantilla->loadDatatables();
        $plantilla->setJs('paginas/habitaciones/js/tipo_habitacion.js'); //esto es el js, no la vista
        return $plantilla->load('habitaciones.tipoHabitaciones');
    }


    public function listarAJAX()
    {
        return TipoHabitacion::all();
    }

    public function guardar(Request $request)
    {
        if (is_null($request->id)) {
            //crear
            TipoHabitacion::create($request->datos);
        } else {
            //editar
            TipoHabitacion::where('id', $request->id)->update($request->datos);
        }
    }


    public function eliminar(Request $request)
    {
        TipoHabitacion::destroy($request->id);
    }
}
