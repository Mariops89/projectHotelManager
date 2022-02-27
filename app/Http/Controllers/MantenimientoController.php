<?php

namespace App\Http\Controllers;

use App\Models\Incidencia;
use App\Services\PlantillaService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class MantenimientoController extends Controller
{

    public function listar(PlantillaService $plantilla)
    {
        $incidencias = Incidencia::whereNull('fecha_resolucion')->orderBy('fecha_notificacion', 'asc')->get();

        $plantilla->setHeader(false);
        $plantilla->setSidebar(false);
        $plantilla->setFooter(false);
        $plantilla->setPageBreadcrumb(false);
        $plantilla->setCss('paginas/mantenimiento/css/mantenimiento.css');
        $plantilla->setJs('paginas/mantenimiento/js/mantenimiento.js');

        return $plantilla->load('mantenimiento/mantenimiento', ['incidencias' => $incidencias]); //cargo la vista y creo el array
    }


    public function incidencia($id, PlantillaService $plantilla)
    {
        $incidencia = Incidencia::findOrFail($id);

        $plantilla->setHeader(false);
        $plantilla->setSidebar(false);
        $plantilla->setFooter(false);
        $plantilla->setPageBreadcrumb(false);
        $plantilla->setCss('paginas/mantenimiento/css/mantenimiento.css');

        return $plantilla->load('mantenimiento/incidencia', $incidencia); //cargo la vista y creo el array
    }


    public function atender(Request $request)
    {
        $usuario = Auth::user();
        $actualizacion = [
            'detalles' => $request->detalles,
            'acciones' => $request->acciones,
            'id_personal' => $usuario->id_personal
        ];

        if ($request->tipo === 'atender') {
            Incidencia::find($request->id)->update($actualizacion);
            return back();

        } elseif ($request->tipo === 'pendiente') {
            Incidencia::find($request->id)->update($actualizacion);
            return redirect()->route('mantenimiento');

        } else {
            $actualizacion['fecha_resolucion'] = Carbon::now();
            Incidencia::find($request->id)->update($actualizacion);
            return redirect()->route('mantenimiento');
        }
    }
}
