<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidencias', function (Blueprint $table) {
            $table->id();
            $table->enum('Tipo' , ['urgente' , 'moderado' , 'no_urgente']);
            $table->text('descripcion');
            $table->foreignId('id_personal')->nullable()->constrained('personal');
            $table->foreignId('id_habitacion')->constrained('habitaciones');
            $table->dateTime('fecha_notificacion')->nullable();
            $table->dateTime('fecha_resolucion')->nullable();
            $table->text('detalles');
            $table->text('acciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incidencias');
    }
}
