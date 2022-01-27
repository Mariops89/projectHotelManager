<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_entrada');
            $table->date('fecha_salida');
            $table->integer('personas');
            $table->integer('precio');
            $table->boolean('late_checkout');
            $table->timestamp('timestamp_salida')->nullable();
            $table->timestamp('timestamp_entrada')->nullable();
            $table->foreignId('id_cliente')->constrained('clientes');
            $table->foreignId('id_habitacion')->constrained('habitaciones');
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
        Schema::dropIfExists('reservas');
    }
}
