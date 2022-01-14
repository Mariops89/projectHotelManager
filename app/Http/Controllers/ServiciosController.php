<?php

namespace App\Http\Controllers;

use App\Models\Servicios;
use App\Services\PlantillaService;
use Illuminate\Http\Request;

class ServiciosController extends Controller
{

    public function listar(PlantillaService $plantilla)
    {
        $tipos = Servicios::all();

        $plantilla->setTitle('Servicios');
        $plantilla->setBreadcrumb(array('servicios'));
        $plantilla->loadDatatables();
        $plantilla->loadSelect2();
        $plantilla->setJs('paginas/servicios/js/servicios.js');
        return $plantilla->load('servicios/servicios');
    }


    public function listarAJAX()
    {
        return Servicios::all();
    }

    public function guardar(Request $request)
    {
        if (is_null($request->id)) {
            //crear
            Servicios::create($request->datos);
        } else {
            //editar
            Servicios::where('id', $request->id)->update($request->datos);
        }
    }


    public function eliminar(Request $request)
    {
        Servicios::destroy($request->id);
    }
}

