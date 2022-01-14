<?php

namespace App\Http\Controllers;

use App\Models\Personal;
use App\Services\PlantillaService;
use Illuminate\Http\Request;

class PersonalController extends Controller
{

    public function listar(PlantillaService $plantilla)
    {
        $plantilla->setTitle('Personal');
        $plantilla->setBreadcrumb(array('personal'));
        $plantilla->loadDatatables();
        $plantilla->setJs('paginas/personal/js/personal.js'); //esto es el js, no la vista
        $plantilla->loadSelect2();
        return $plantilla->load('personal/personal'); //la vista
    }


    public function listarAJAX()
    {
        return Personal::all();
    }


    public function guardar(Request $request)
    {
        if (is_null($request->id)) {
            //crear
            Personal::create($request->datos);
        } else {
            //editar
            Personal::where('id', $request->id)->update($request->datos);
        }
    }


    public function eliminar(Request $request)
    {
        Personal::destroy($request->id);
    }
}

