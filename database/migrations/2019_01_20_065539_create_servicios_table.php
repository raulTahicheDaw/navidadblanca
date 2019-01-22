<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fecha');
            $table->string('hora_comienzo');
            $table->string('hora_fin');
            $table->string('descripcion');
            $table->string('estado');
            $table->string('cliente');
            $table->string('num_orden');
            $table->string('observaciones')->nullable();
            $table->string('matricula')->nullable();
            $table->integer('pax');
            $table->integer('conductor_id')->unsigned();
            $table->integer('tipo_servicio_id')->unsigned();
            $table->timestamps();

            $table->foreign('conductor_id')->references('id')->on('conductors');
            $table->foreign('tipo_servicio_id')->references('id')->on('tipos_servicios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servicios');
    }
}
