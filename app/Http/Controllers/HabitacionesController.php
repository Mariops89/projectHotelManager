<?php

namespace App\Http\Controllers;

use App\Models\Habitacion;
use App\Models\TipoHabitacion;
use App\Services\PlantillaService;
use Illuminate\Http\Request;

class HabitacionesController extends Controller
{

    public function listar(PlantillaService $plantilla)
    {
        $tipos = TipoHabitacion::all();

        $plantilla->setTitle('Habitaciones');
        $plantilla->setBreadcrumb(array('habitaciones'));
        $plantilla->loadDatatables();
        $plantilla->loadSelect2();
        $plantilla->setJs('paginas/habitaciones/js/habitaciones.js');
        return $plantilla->load('habitaciones/habitaciones', ['tipos' => $tipos]);
    }


    public function listarAJAX()
    {
        return Habitacion::with('tipo')->get();
    }

    public function guardar(Request $request)
    {
        if (is_null($request->id)) {
            //crear
            Habitacion::create($request->datos);
        } else {
            //editar
            Habitacion::where('id', $request->id)->update($request->datos);
        }
    }


    public function eliminar(Request $request)
    {
        Habitacion::destroy($request->id);
    }
}
