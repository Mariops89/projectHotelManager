<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuardarIncidenciaRequest;
use App\Models\Habitacion;
use App\Models\Incidencia;
use App\Services\PlantillaService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class IncidenciasController extends Controller
{

    public function listar(PlantillaService $plantilla)
    {
        $habitaciones = Habitacion::orderBy('numero')->get();

        $plantilla->setTitle('Incidencias');
        $plantilla->setIcon('fas fa-exclamation-triangle');
        $plantilla->setBreadcrumb(array('Incidencias'));
        $plantilla->loadDatatables();
        $plantilla->loadSelect2();
        $plantilla->loadDaterangepicker();
        $plantilla->setJs('paginas/incidencias/js/incidencias.js'); //esto es el js, no la vista

        return $plantilla->load('incidencias/incidencias', ['habitaciones' => $habitaciones]); //cargo la vista y creo el array
    }


    public function listarAJAX(Request $request)
    {
        return Incidencia::with('habitacion', 'personal')->whereBetween('fecha_notificacion', [$request->inicio, $request->fin])->get();
    }


    public function guardar(GuardarIncidenciaRequest $request)
    {
        if (is_null($request->id)) {
            //crear
            $array = $request->validated();
            $array ['fecha_notificacion'] = Carbon::now();
            Incidencia::create($array);
        } else {
            //editar
            Incidencia::find($request->id)->update($request->validated());
        }

    }


    public function eliminar(Request $request)
    {
        Incidencia::destroy($request->id);
    }
}
