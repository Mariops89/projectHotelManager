<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuardarServicioRequest;
use App\Models\Servicio;
use App\Services\PlantillaService;
use Illuminate\Http\Request;

class ServiciosController extends Controller
{

    public function listar(PlantillaService $plantilla)
    {
        $tipos = Servicio::all();

        $plantilla->setTitle('Servicios');
        $plantilla->setBreadcrumb(array('Servicios'));
        $plantilla->loadDatatables();
        $plantilla->loadSelect2();
        $plantilla->setJs('paginas/servicios/js/servicios.js');
        return $plantilla->load('servicios/servicios');
    }


    public function listarAJAX()
    {
        return Servicio::all();
    }

    public function guardar(GuardarServicioRequest $request)
    {
        if (is_null($request->id)) {
            //crear
            Servicio::create($request->validated());
        } else {
            //editar
            Servicio::where('id', $request->id)->update($request->validated());
        }
    }


    public function eliminar(Request $request)
    {
        Servicio::destroy($request->id);
    }
}

