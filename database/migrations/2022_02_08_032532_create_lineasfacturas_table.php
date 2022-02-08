<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLineasfacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lineasfacturas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_factura')->constrained('facturas');
            $table->string('concepto', 500);
            $table->integer('cantidad');
            $table->integer('precio');
            $table->float('iva');
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
        Schema::dropIfExists('lineasfacturas');
    }
}
