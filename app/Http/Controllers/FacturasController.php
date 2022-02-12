<?php

namespace App\Http\Controllers;
use App\Http\Requests\GuardarFacturaRequest;
use App\Http\Requests\GuardarIncidenciaRequest;
use App\Models\Factura;
use App\Models\Habitacion;
use App\Models\Reserva;
use App\Services\PlantillaService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class FacturasController
{
    public function listar(PlantillaService $plantilla)
    {
        $reservas = Reserva::all();
        $habitaciones = Habitacion::all();

        $plantilla->setTitle('Historial de facturas');
        $plantilla->setBreadcrumb(array('Facturas'));
        $plantilla->loadDatatables();
        $plantilla->loadDaterangepicker();
        $plantilla->loadSelect2();
        $plantilla->setJs('paginas/facturas/js/facturas.js'); //esto es el js, no la vista

        return $plantilla->load('facturas/facturas',
            ['reservas' => $reservas]);
        //cargo la vista y creo el array
    }

    public function listarAJAX()
    {
        return Factura::with(['habitacion', 'cliente'])->get();
    }


    public function guardar(GuardarFacturaRequest $request)
    {

        if (is_null($request->id)) {
            //crear
            $ultima_factura = (Factura::select('numero')->where('created_at', Factura::max('created_at'))->first());
            //el segundo parámetro es la última fecha
            if ($ultima_factura != null) {
                $num_factura = substr($ultima_factura, 1); // nos quedamos con el número en string
                $num_factura = intval($num_factura);//en formato int
                $num_nuevo = $num_factura + 1;
                $nueva_factura = 'F' . $num_nuevo;
                //create con el nuevo numero
                $array = $request->validated();
                $array ['numero'] = $nueva_factura;
                Factura::create($array());
            } else {
                //create con F1
                $array = $request->validated();
                $array ['numero'] = 'F1';
                //dd($array, $request->all(), $request->validated());
                Factura::create($array);
            }
        } else {
            //editar
            Factura::find($request->id)->update($request->validated());
        }

    }


    public function eliminar(Request $request)
    {
        Factura::destroy($request->id);
    }
}
