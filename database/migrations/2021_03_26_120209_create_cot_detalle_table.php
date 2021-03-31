<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCotDetalleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cot_detalle', function (Blueprint $table) {
             $table->id();
             $table->foreignId('id_cotizacion')->constrained('cotizaciones');
             $table->foreignId('id_producto')->constrained('productos');
             $table->integer('cantidad');
             $table->integer('precio');
            $table->integer('total');
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
        Schema::dropIfExists('cot_detalle');
    }
}
