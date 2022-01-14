<?php

namespace App\Http\Controllers;

use App\Models\Login;
use App\Services\PlantillaService;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function listar(PlantillaService $plantilla)
    {
        $plantilla->setHeader(false);
        $plantilla->setSidebar(false);
        $plantilla->setFooter(false);
        $plantilla->setPageBreadcrumb(false);
        $plantilla->setTitle('Login');
       /* $plantilla->setBreadcrumb(array('clientes'));
        $plantilla->loadDatatables();
        $plantilla->setJs('paginas/clientes/js/clientes.js'); //esto es el js, no la vista*/

        return $plantilla->load('login/login'); //la vista
    }

}
