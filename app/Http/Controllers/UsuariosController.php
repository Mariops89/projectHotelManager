<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuardarUsuarioRequest;
use App\Models\Personal;
use App\Models\Usuario;
use App\Services\PlantillaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{

    public function listar(PlantillaService $plantilla)
    {

        $personas = Personal::all();
        $plantilla->setTitle('Usuarios');
        $plantilla->setIcon('fas fa-users');
        $plantilla->setBreadcrumb(array('usuarios'));
        $plantilla->loadDatatables();
        $plantilla->loadSelect2();
        $plantilla->setJs('paginas/usuarios/js/usuarios.js'); //esto es el js, no la vista

        return $plantilla->load('usuarios/usuarios', ['personas' => $personas]); //la vista
    }


    public function listarAJAX()
    {
        return Usuario::with('personal')->get();
    }


    public function guardar(GuardarUsuarioRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);

        if (is_null($request->id)) {
            //crear
            Usuario::create($validated);
        } else {
            //editar
            Usuario::find($request->id)->update($validated);
        }
    }


    public function eliminar(Request $request)
    {
        Usuario::destroy($request->id);
    }
}

