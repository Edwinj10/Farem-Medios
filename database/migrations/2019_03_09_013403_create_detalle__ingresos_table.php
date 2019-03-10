<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleIngresosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle__ingresos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ingreso_id')->unsigned();
            $table->integer('medio_id')->unsigned();
            $table->integer('cantidad');
            $table->timestamps();
            $table->foreign('ingreso_id')->references('id')->on('ingresos')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('medio_id')->references('id')->on('medios')
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
        Schema::dropIfExists('detalle__ingresos');
    }
}
