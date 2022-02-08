<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservaServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserva_servicios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_reserva')->constrained('reservas');
            $table->foreignId('id_servicio')->constrained('servicios');
            $table->date('fecha');
            $table->dateTime('hora_inicio');
            $table->dateTime('hora_fin');
            $table->integer('precio');
            $table->timestamps();
        }); // no migrada
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reserva_servicios');
    }
}
