<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateServiciosEnum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('servicios', function (Blueprint $table) {
            //Borrar
            $table->dropColumn('estado');
        });
        Schema::table('servicios', function (Blueprint $table) {
            //Añadir
            $table->enum('estado', ['activo' , 'inactivo']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('servicios', function (Blueprint $table) {
            $table->dropColumn('estado');
        });
        Schema::table('servicios', function (Blueprint $table) {
            $table->string('estado', 25);
        });
    }
}
