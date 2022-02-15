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
        $plantilla->setTitle('Historial de facturas');
        $plantilla->setBreadcrumb(array('Facturas'));
        $plantilla->loadDatatables();
        $plantilla->loadDaterangepicker();
        $plantilla->loadSelect2();
        $plantilla->setCss('paginas/facturas/css/facturas.css'); //esto es el js, no la vista
        $plantilla->setJs('paginas/facturas/js/facturas.js'); //esto es el js, no la vista

        return $plantilla->load('facturas/facturas');
        //cargo la vista y creo el array
    }

    public function listarAJAX()
    {
        return Factura::with(['reserva', 'reserva.habitacion', 'reserva.cliente', 'lineas'])
            ->get()
            ->each(function ($factura) {
                $factura->subtotal = $factura->lineas->sum('base_imponible');
                $factura->iva = $factura->lineas->sum('iva');
                $factura->total = $factura->lineas->sum('subtotal');
            });
    }


    public function guardar(GuardarFacturaRequest $request)
    {
        if (is_null($request->id)) {
            //crear
            $array = $request->validated();
            $array['fecha'] = Carbon::today();

            $ultima_factura = Factura::where('created_at', Factura::max('created_at'))->first();
            //el segundo parámetro es la última fecha
            if (!is_null($ultima_factura)) {
                $num_factura = substr($ultima_factura->numero, 1); // nos quedamos con el número en string
                $num_factura = intval($num_factura);//en formato int
                $num_nuevo = $num_factura + 1;
                $nueva_factura = 'F' . $num_nuevo;
                //create con el nuevo numero
                $array ['numero'] = $nueva_factura;

            } else {
                //create con F1
                $array ['numero'] = 'F1';
                //dd($array, $request->all(), $request->validated());
            }

            if (is_null($request->pagada)) {
                $array['timestamp_pago'] = null;
                $array['forma_pago'] = null;
            } else {
                $array['timestamp_pago'] = Carbon::now();
            }

            $factura = Factura::create($array);

            $reserva = Reserva::find($array['id_reserva']);
            $entrada = Carbon::parse($reserva->fecha_entrada)->format('d/m/Y');
            $salida = Carbon::parse($reserva->fecha_salida)->format('d/m/Y');

            $factura->lineas()->create([
                'concepto' => 'Estancia (' . $entrada . ' - ' . $salida . ')',
                'cantidad' => 1,
                'precio' => $reserva->precio / 1.1,
                'base_imponible' => $reserva->precio / 1.1,
                'iva' => $reserva->precio - $reserva->precio / 1.1,
                'subtotal' => $reserva->precio
            ]);

        } else {
            //editar
            $array = $request->validated();
            if (is_null($request->pagada)) {
                $array['timestamp_pago'] = null;
                $array['forma_pago'] = null;
            } else {
                $array['timestamp_pago'] = Carbon::now();
            }
            Factura::find($request->id)->update($array);
        }

    }


    public function eliminar(Request $request)
    {
        Factura::destroy($request->id);
    }
}
