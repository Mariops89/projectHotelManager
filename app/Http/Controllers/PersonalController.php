<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuardarPersonalRequest;
use App\Models\Incidencia;
use App\Models\Personal;
use App\Services\PlantillaService;
use Illuminate\Http\Request;

class PersonalController extends Controller
{

    public function listar(PlantillaService $plantilla)
    {
        $plantilla->setTitle('Personal');
        $plantilla->setIcon('fas fa-tools');
        $plantilla->setBreadcrumb(array('Personal'));
        $plantilla->loadDatatables();
        $plantilla->setJs('paginas/personal/js/personal.js'); //esto es el js, no la vista
        $plantilla->loadSelect2();
        return $plantilla->load('personal/personal'); //la vista
    }


    public function listarAJAX()
    {
        return Personal::all();
    }


    public function guardar(GuardarPersonalRequest $request)
    {
        if (is_null($request->id)) {
            //crear
            Personal::create($request->validated());
        } else {
            //editar
            Personal::find($request->id)->update($request->validated());
        }
    }


    public function eliminar(Request $request)
    {
        if (Incidencia::where('id_personal', $request->id)->doesntExist()) {
            Personal::destroy($request->id);
            $borrado = true;
        } else {
            $borrado = false;
        }

        return ['borrado' => $borrado];
    }
}

