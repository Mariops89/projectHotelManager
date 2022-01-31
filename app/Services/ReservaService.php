<?php

namespace App\Services;

use App\Models\Habitacion;
use App\Models\Reserva;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class ReservaService
{
    public const INICIO_TEMPORADA_ALTA = '-06-15';
    public const FIN_TEMPORADA_ALTA = '-09-21';

    private $fecha_entrada;
    private $fecha_salida;
    private $idTipoHabitacion;
    private $personas;

    /**
     * @param $fecha_entrada
     * @param $fecha_salida
     * @param $idTipoHabitacion
     * @param $personas
     */
    public function __construct($fecha_entrada, $fecha_salida, $idTipoHabitacion, $personas)
    {
        $this->fecha_entrada = $fecha_entrada;
        $this->fecha_salida = $fecha_salida;
        $this->idTipoHabitacion = $idTipoHabitacion;
        $this->personas = $personas;
    }


    private function temporadaAlta($fecha)
    {
        $ano = Carbon::parse($fecha)->year;

        return $fecha >= $ano . self::INICIO_TEMPORADA_ALTA && $fecha <= $ano . self::FIN_TEMPORADA_ALTA;
    }


    public function habitacionesDisponibles()
    {
        $reservas = Reserva::intervalo($this->fecha_entrada, $this->fecha_salida)->get();
        $habitaciones_reservadas = $reservas->pluck('id_habitacion');

        $habitaciones = Habitacion::with('tipo')
            ->where('personas', '>=', $this->personas)
            ->whereNotIn('id', $habitaciones_reservadas);

        if (!empty($this->idTipoHabitacion)) {
            $habitaciones->whereIn('id_tipo_habitacion', $this->idTipoHabitacion);
        }

        $habitaciones = $habitaciones->get()->each(function ($habitacion) {
            $habitacion->precio_estancia = 0;
            foreach (CarbonPeriod::create($this->fecha_entrada, $this->fecha_salida) as $fecha) {
                if ($this->temporadaAlta($fecha)) {
                    $habitacion->precio_estancia += $habitacion->tipo->precio_alta;
                } else {
                    $habitacion->precio_estancia += $habitacion->tipo->precio_baja;
                }
            }
        });

        return $habitaciones;
    }
}
