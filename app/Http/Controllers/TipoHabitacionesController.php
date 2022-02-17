<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuardarTipoHabitacionRequest;
use App\Models\TipoHabitacion;
use App\Services\PlantillaService;
use Illuminate\Http\Request;

class TipoHabitacionesController extends Controller
{

    public function listar(PlantillaService $plantilla)
    {
        $plantilla->setTitle('Tipos de habitaciones');
        $plantilla->setIcon('fas fa-bed');
        $plantilla->setBreadcrumb(array('Tipos de habitaciones'));
        $plantilla->loadDatatables();
        $plantilla->setJs('paginas/habitaciones/js/tipo_habitacion.js'); //esto es el js, no la vista
        return $plantilla->load('habitaciones.tipoHabitaciones');
    }


    public function listarAJAX()
    {
        return TipoHabitacion::all();
    }

    public function guardar(GuardarTipoHabitacionRequest $request)
    {
        if (is_null($request->id)) {
            //crear
            TipoHabitacion::create($request->validated());
        } else {
            //editar
            TipoHabitacion::find($request->id)->update($request->validated());
        }
    }


    public function eliminar(Request $request)
    {
        TipoHabitacion::destroy($request->id);
    }
}
