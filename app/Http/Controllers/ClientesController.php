<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuardarClienteRequest;
use App\Models\Cliente;
use App\Services\PlantillaService;
use Illuminate\Http\Request;

class ClientesController extends Controller
{

    public function listar(PlantillaService $plantilla)
    {
        $plantilla->setTitle('Clientes');
        $plantilla->setBreadcrumb(array('clientes'));
        $plantilla->loadDatatables();
        $plantilla->setJs('paginas/clientes/js/clientes.js'); //esto es el js, no la vista

        return $plantilla->load('clientes/clientes'); //la vista
    }


    public function listarAJAX()
    {
       return Cliente::all();
    }


    public function guardar(GuardarClienteRequest $request)
    {
        if (is_null($request->id)) {
            //crear
            Cliente::create($request->validated());
        } else {
            //editar
            Cliente::where('id', $request->id)->update($request->validated());
        }
    }


    public function eliminar(Request $request)
    {
        Cliente::destroy($request->id);
    }
}
