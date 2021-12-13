<?php

namespace App\Http\Controllers;

use App\Services\PlantillaService;
use Illuminate\Http\Request;

class HabitacionesController extends Controller
{

    public function listar(PlantillaService $plantilla)
    {
        $plantilla->setTitle('Habitaciones');
        $plantilla->setBreadcrumb(array('Habitaciones'));
        return $plantilla->load('habitaciones/habitaciones');
    }
}
