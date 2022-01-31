<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuardarClienteRequest;
use App\Models\Cliente;
use App\Services\PlantillaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function mostrar(PlantillaService $plantilla)
    {
        $plantilla->setTitle('Dashboard');
        $plantilla->setBreadcrumb(array('Dashboard'));

        return $plantilla->load('dashboard/dashboard'); //la vista
    }
}
