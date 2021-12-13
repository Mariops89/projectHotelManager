<?php

namespace App\Http\Controllers;

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
        $plantilla->setJs('paginas/clientes/js/clientes.js');

        return $plantilla->load('clientes/clientes');
    }


    public function listarAJAX()
    {
       return Cliente::all();
    }
}
