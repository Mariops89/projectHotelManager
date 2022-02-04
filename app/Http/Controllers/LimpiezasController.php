<?php

namespace App\Http\Controllers;

use App\Models\Limpieza;
use App\Services\PlantillaService;

class LimpiezasController
{
    public function listar(PlantillaService $plantilla)
    {
        $plantilla->setTitle('Lista de limpieza');
        $plantilla->setBreadcrumb(array('Limpieza'));
        $plantilla->loadDatatables();
        $plantilla->loadSelect2();
        $plantilla->setJs('paginas/limpieza/js/limpieza.js'); //esto es el js, no la vista

        return $plantilla->load('limpieza/limpiezas');
    }

    public function listarAJAX()
    {
        return Limpieza::with(['habitacion', 'reserva'])->get();
    }

}
