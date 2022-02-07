<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuardarHabitacionRequest;
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
        $plantilla->setBreadcrumb(array('Habitaciones'));
        $plantilla->loadDatatables();
        $plantilla->loadSelect2();
        $plantilla->setJs('paginas/habitaciones/js/habitaciones.js');
        return $plantilla->load('habitaciones/habitaciones', ['tipos' => $tipos]);
    }


    public function listarAJAX()
    {
        return Habitacion::with('tipo')->get();
    }

    public function guardar(GuardarHabitacionRequest $request)
    {
        if (is_null($request->id)) {
            //crear
            Habitacion::create($request->validated());
        } else {
            //editar
            Habitacion::find($request->id)->update($request->validated());
        }
    }


    public function eliminar(Request $request)
    {
        Habitacion::destroy($request->id);
    }
}
