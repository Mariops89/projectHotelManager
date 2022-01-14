<?php

namespace App\Http\Controllers;

use App\Models\Personal;
use App\Models\Usuarios;
use App\Services\PlantillaService;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{

    public function listar(PlantillaService $plantilla)
    {

        $personas = Personal::all();
        $plantilla->setTitle('Usuarios');
        $plantilla->setBreadcrumb(array('usuarios'));
        $plantilla->loadDatatables();
        $plantilla->loadSelect2();
        $plantilla->setJs('paginas/usuarios/js/usuarios.js'); //esto es el js, no la vista

        return $plantilla->load('usuarios/usuarios', ['personas' => $personas]); //la vista
    }


    public function listarAJAX()
    {
        return Usuarios::with('personal')->get();
    }


    public function guardar(Request $request)
    {
        if (is_null($request->id)) {
            //crear
            Usuarios::create($request->datos);
        } else {
            //editar
            Usuarios::where('id', $request->id)->update($request->datos);
        }
    }


    public function eliminar(Request $request)
    {
        Usuarios::destroy($request->id);
    }
}

