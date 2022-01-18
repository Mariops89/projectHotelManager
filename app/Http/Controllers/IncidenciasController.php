<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuardarClienteRequest;
use App\Http\Requests\GuardarIncidenciaRequest;
use App\Models\Incidencia;
use App\Services\PlantillaService;
use Illuminate\Http\Request;

class IncidenciasController extends Controller
{

    public function listar(PlantillaService $plantilla)
    {
        $plantilla->setTitle('incidencias');
        $plantilla->setBreadcrumb(array('incidencias'));
        $plantilla->loadDatatables();
        $plantilla->setJs('paginas/incidencias/js/incidencias.js'); //esto es el js, no la vista

        return $plantilla->load('incidencias/incidencias'); //la vista
    }


    public function listarAJAX()
    {
        return Incidencia::all();
    }


    public function guardar(GuardarIncidenciaRequest $request)
    {
        if (is_null($request->id)) {
            //crear
            Incidencia::create($request->validated());
        } else {
            //editar
            Incidencia::where('id', $request->id)->update($request->validated());
        }
    }


    public function eliminar(Request $request)
    {
        Incidencia::destroy($request->id);
    }
}
