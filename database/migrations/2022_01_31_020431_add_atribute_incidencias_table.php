<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAtributeIncidenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('incidencias', function (Blueprint $table) {
            $table->foreignId('id_personal')->nullable()->change()->constrained('personal');
            $table->dateTime('fecha_notificacion')->nullable()->change();
            $table->dateTime('fecha_resolucion')->nullable()->change();
            $table->text('acciones')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('incidencias', function (Blueprint $table) {
            $table->dropColumn('id_personal'); // borrar
            $table->dropColumn('fecha_notificacion');
            $table->dropColumn('fecha_resolucion');
            $table->dropColumn('acciones');
        });
    }
}
