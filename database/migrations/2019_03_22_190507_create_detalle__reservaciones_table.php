<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleReservacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle__reservaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reservacion_id')->unsigned();
            $table->integer('medio_id')->unsigned();
            $table->integer('periodo_id')->unsigned();
            $table->integer('cantidad');
            $table->timestamps();
            $table->foreign('reservacion_id')->references('id')->on('reservaciones')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('medio_id')->references('id')->on('medios')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('periodo_id')->references('id')->on('periodos')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle__reservaciones');
    }
}
